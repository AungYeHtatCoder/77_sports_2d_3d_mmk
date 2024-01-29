<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ThreeDigit\Lotto;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ThreeDigit\ThreeDigit;
use App\Models\ThreeDigit\ThreeDigitOverLimit;
use App\Models\ThreeDigit\LotteryThreeDigitPivot;
use Illuminate\Support\Facades\Validator;
class TestController extends Controller
{
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'selected_digits' => 'required|string',
        'amounts' => 'required|array',
        'amounts.*' => 'required|integer',
        'totalAmount' => 'required|numeric',
        'user_id' => 'required|exists:users,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $limit = DB::table('three_d_d_limits')->first(); // Define the limit amount
    $limitAmount = $limit->three_d_limit;
    $commission_percent = DB::table('commissions')->first(); // Get first commission from Commission Table

    DB::beginTransaction();

    try {
        $user = Auth::user();
        $user->balance -= $request->totalAmount;

        if ($user->balance < 0) {
            // If insufficient balance, throw an exception
            throw new \Exception('Insufficient balance.');
        }

        // Commission calculation
        $commission = 0;
        if ($request->totalAmount >= 1000) {
            $commission = ($request->totalAmount * $commission_percent->commission) / 100;
            $user->commission_balance += $commission;
        }
        
        $user->save();

        $lottery = Lotto::create([
            'total_amount' => $request->totalAmount,
            'user_id' => $request->user_id,
        ]);

        foreach ($request->amounts as $three_digit_string => $sub_amount) {
            $three_digit_id = $three_digit_string === '00' ? 1 : intval($three_digit_string, 10) + 1;

            $totalBetAmountForThreeDigit = DB::table('lotto_three_digit_copy')
                ->where('three_digit_id', $three_digit_id)
                ->sum('sub_amount');

            if ($totalBetAmountForThreeDigit + $sub_amount <= $limitAmount) {
                // Place bet within limit
                LotteryThreeDigitPivot::create([
                    'lotto_id' => $lottery->id,
                    'three_digit_id' => $three_digit_id,
                    'sub_amount' => $sub_amount,
                    'prize_sent' => false
                ]);
            } else {
                // If the bet is over the limit, split it accordingly
                if ($totalBetAmountForThreeDigit < $limitAmount) {
                    // The amount within the limit
                    LotteryThreeDigitPivot::create([
                        'lotto_id' => $lottery->id,
                        'three_digit_id' => $three_digit_id,
                        'sub_amount' => $limitAmount - $totalBetAmountForThreeDigit,
                        'prize_sent' => false
                    ]);
                }

                // The amount over the limit
                ThreeDigitOverLimit::create([
                    'lotto_id' => $lottery->id,
                    'three_digit_id' => $three_digit_id,
                    'sub_amount' => $sub_amount - ($limitAmount - $totalBetAmountForThreeDigit),
                    'prize_sent' => false
                ]);
            }
        }

        DB::commit();
        return response()->json([
            'message' => 'Successfully placed bet.',
            'data' => [
                'lottery' => $lottery,
                'commission' => $commission
            ]
        ], 201);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}