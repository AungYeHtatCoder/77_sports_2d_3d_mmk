<?php

namespace App\Http\Controllers\Api\Jackpot;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Currency;
use App\Models\Jackpot\Jackpot;
use App\Models\Admin\Commission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Jackpot\JackpotLimit;
use App\Models\User\JackpotTwoDigit;
use Illuminate\Support\Facades\Auth;
use App\Models\User\JackpotTwoDigitCopy;
use App\Models\User\JackpotTwoDigitOver;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class JackpotController extends Controller
{
    use HttpResponses;
    public function store(Request $request)
    {
        // Log the entire request
        //Log::info($request->all());
        $limitAmount = JackpotLimit::latest()->first()->jack_limit;
        // Convert JSON request to an array
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            //'currency' => 'required|string',
            'currency' => 'required|string|in:baht,bath,mmk',
            'totalAmount' => 'required|numeric|min:1',
            'amounts' => 'required|array',
            'amounts.*.num' => 'required|integer',
            'amounts.*.amount' => 'required|integer|min:1',
        ]);
        // Check for validation errors
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        //$commission_percent = Commission::latest()->first()->commission;
        $commission_percent = 0.5;
        DB::beginTransaction();

        try {
            $rate = Currency::latest()->first()->rate;
            //total_amount
            if($request->currency == 'baht'){
                $totalAmount = $request->totalAmount * $rate;
            }else{
                $totalAmount = $request->totalAmount;
            }
            //sub_amount
            if ($request->currency == "baht") {
                $subAmount = array_sum(array_column($request->amounts, 'amount')) * $rate;
            }else{
                $subAmount = array_sum(array_column($request->amounts, 'amount'));
            }
            
            if ($subAmount > $limitAmount) {
                return response()->json(['message' => 'Limit ပမာဏထက်ကျော်ထိုးလို့ မရပါ။'], 401);
            }

            $user = Auth::user();
            $user->balance -= $totalAmount;

            if ($user->balance < 0) {
                throw new \Exception('လက်ကျန်ငွေ မလုံလောက်ပါ။');
            }
            /** @var \App\Models\User $user */
            $user->save();
            // commission calculation
            if($totalAmount >= 1000){
                $commission = ($totalAmount * $commission_percent) / 100;
                $user->commission_balance += $commission;
                $user->save();
            }
            $lottery = Jackpot::create([
                'pay_amount' => $totalAmount,
                'total_amount' => $totalAmount,
                'user_id' => $request->user_id
            ]);

            foreach ($request->amounts as $amount) {
                $two_digit_string = $amount['num'];
                $sub_amount = $amount['amount'];

                $two_digit_id = $two_digit_string === '00' ? 1 : intval($two_digit_string, 10) + 1;

                $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
                    ->where('two_digit_id', $two_digit_id)
                    ->sum('sub_amount');
                $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
                $overLimit = $sub_amount - $withinLimit;
                //currency auto exchange
                if($request->currency == "baht"){
                    $sub_amount = $sub_amount * $rate;
                }

                if ($totalBetAmountForTwoDigit >= 0) {
                    $pivot = new JackpotTwoDigit([
                        
                        'jackpot_id' => $lottery->id,
                        'two_digit_id' => $two_digit_id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false
                    ]);
                    $pivot->save();
                } 

                if ($overLimit > 0) {
                    $pivotOver = new JackpotTwoDigitOver([
                        'jackpot_id' => $lottery->id,
                        'two_digit_id' => $two_digit_id,
                        'sub_amount' => $overLimit,
                        'prize_sent' => false
                    ]);
                    $pivotOver->save();
                }
            }

            DB::commit();
            return $this->success([
                'message' => 'Successfully placed bet.',
                'data' => $lottery
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in store method: ' . $e->getMessage());

            // Return an error response
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function OnceMonthJackpotHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getUserOneMonthJackpotDigits($userId);
        return response()->json([
            'displayThreeDigits' => $displayJackpotDigit,
        ]);
    }

    public function getOneMonthJackpotHistory($startDate, $endDate)
    {
        $startDate = Carbon::createFromFormat('d-M-Y', $startDate);
        $endDate = Carbon::createFromFormat('d-M-Y', $endDate);

        $history = DB::table('jackpot_two_digit')
            ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
            ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
            ->join('users', 'jackpots.user_id', '=', 'users.id')
            ->whereBetween('jackpot_two_digit.created_at', [$startDate, $endDate])
            ->select('jackpot_two_digit.*', 'jackpots.pay_amount', 'jackpots.total_amount', 'two_digits.two_digit', 'users.name as user_name')
            ->orderBy('jackpot_two_digit.created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $history
        ]);
    }

    // public function getOneMonthJackpotHistory()
    // {
    //     try {
    //         $oneMonthAgo = Carbon::now()->subMonth();
    //         $userId = Auth::id(); // Get the authenticated user's ID

    //         $history = DB::table('jackpot_two_digit')
    //             ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
    //             ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
    //             ->join('users', 'jackpots.user_id', '=', 'users.id')
    //             ->where('jackpot_two_digit.created_at', '>=', $oneMonthAgo)
    //             ->where('jackpots.user_id', '=', $userId) // Filter by user ID
    //             ->select('jackpot_two_digit.*', 'jackpots.pay_amount', 'jackpots.total_amount', 'two_digits.two_digit', 'users.name as user_name')
    //             ->orderBy('jackpot_two_digit.created_at', 'desc')
    //             ->get();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data retrieved successfully',
    //             'data' => $history
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
}