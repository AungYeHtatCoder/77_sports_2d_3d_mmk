<?php

namespace App\Http\Controllers\User\AM9;

use App\Models\Admin\Currency;
use App\Models\Lottery;
use Illuminate\Http\Request;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\LotteryTwoDigitPivot;
use Illuminate\Support\Facades\Auth;
use App\Models\Two\LotteryTwoDigitOverLimit;

class TwoDplay9AMController extends Controller
{
    public function index()
    {
        $twoDigits = TwoDigit::all();

        // Calculate remaining amounts for each two-digit
        $remainingAmounts = [];
        foreach ($twoDigits as $digit) {
            $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                ->where('two_digit_id', $digit->id)
                ->sum('sub_amount');

            $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
        }
        $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

        return view('frontend.two_d.9_am.twoDPlayAM', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));
    }

    public function play_confirm()
    {
        $twoDigits = TwoDigit::all();

        // Calculate remaining amounts for each two-digit
        $remainingAmounts = [];
        foreach ($twoDigits as $digit) {
            $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                ->where('two_digit_id', $digit->id)
                ->sum('sub_amount');

            $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
        }
        $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

        return view('frontend.two_d.9_am.twoDPlayAMConfirm', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));
    }


    public function store(Request $request)
    {
        Log::info($request->all());
        $validatedData = $request->validate([
            'currency' => 'required',
            'selected_digits' => 'required|string',
            'amounts' => 'required|array',
            'amounts.*' => 'required|integer|min:1|max:50000',
            //'totalAmount' => 'required|integer|min:100',
            'totalAmount' => 'required|numeric|min:1', // Changed from integer to numeric
            'user_id' => 'required|exists:users,id',
        ]);

        $currentSession = date('H') < 12 ? 'morning' : 'evening';
        //$limitAmount = 50000; // Define the limit amount
        $limit = DB::table('two_d_limits')->first(); // Define the limit amount
        $limitAmount = $limit->two_d_limit;
        // get first commission From Commission Table
        $commission_percent = DB::table('commissions')->first();
        DB::beginTransaction();

        try {
            $rate = Currency::latest()->first()->rate;
            if($request->currency == 'baht'){
                $totalAmount = $request->totalAmount * $rate;
            }else{
                $totalAmount = $request->totalAmount;
            }

            $user = Auth::user();
            $user->balance -= $totalAmount;

            if ($user->balance < 0) {
                throw new \Exception('Insufficient balance.');
            }
            /** @var \App\Models\User $user */
            $user->save();
            // commission calculation
        
            $lottery = Lottery::create([
                'pay_amount' => $totalAmount,
                'total_amount' => $totalAmount,
                'user_id' => $request->user_id,
                'session' => $currentSession
            ]);

            foreach ($request->amounts as $two_digit_string => $sub_amount) {
                $two_digit_id = $two_digit_string === '00' ? 1 : intval($two_digit_string, 10) + 1;

                $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                    ->where('two_digit_id', $two_digit_id)
                    ->sum('sub_amount');

                //currency auto exchange
                if($request->currency == "baht"){
                    $sub_amount = $sub_amount * $rate;
                }

                if ($totalBetAmountForTwoDigit + $sub_amount <= $limitAmount) {
                    $pivot = new LotteryTwoDigitPivot([
                        'lottery_id' => $lottery->id,
                        'two_digit_id' => $two_digit_id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false
                    ]);
                    $pivot->save();
                } else {
                    $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
                    $overLimit = $sub_amount - $withinLimit;

                    if ($withinLimit > 0) {
                        $pivotWithin = new LotteryTwoDigitPivot([
                            'lottery_id' => $lottery->id,
                            'two_digit_id' => $two_digit_id,
                            'sub_amount' => $withinLimit,
                            'prize_sent' => false
                        ]);
                        $pivotWithin->save();
                    }

                    if ($overLimit > 0) {
                        $pivotOver = new LotteryTwoDigitOverLimit([
                            'lottery_id' => $lottery->id,
                            'two_digit_id' => $two_digit_id,
                            'sub_amount' => $overLimit,
                            'prize_sent' => false
                        ]);
                        $pivotOver->save();
                    }
                }
            }

            DB::commit();
            session()->flash('SuccessRequest', 'Successfully placed bet.');

            return redirect()->route('user.twodHistory')->with('success', 'Data stored successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in store method: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}