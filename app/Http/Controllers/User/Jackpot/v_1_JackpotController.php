<?php

namespace App\Http\Controllers\User\Jackpot;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Currency;
use App\Models\Admin\TwoDigit;
use App\Models\User\Jackmatch;
use App\Models\Jackpot\Jackpot;
use App\Models\Admin\Commission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Jackpot\JackpotLimit;
use App\Models\User\JackpotTwoDigit;
use Illuminate\Support\Facades\Auth;
use App\Models\User\JackpotTwoDigitOver;

class JackpotController extends Controller
{
    public function index()
    {
        $twoDigits = TwoDigit::all();

        // Calculate remaining amounts for each two-digit
        $remainingAmounts = [];
        foreach ($twoDigits as $digit) {
            $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
                ->where('two_digit_id', $digit->id)
                ->sum('sub_amount');

            $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
        }
        $lottery_matches = Jackmatch::where('id', 1)->whereNotNull('is_active')->first();

        return view('jackpot.jackpot_index', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));
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
        $lottery_matches = Jackmatch::where('id', 1)->whereNotNull('is_active')->first();

        return view('jackpot.jackpot_play_confirm', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));
    }


    public function store(Request $request)
    {
        Log::info($request->all());
        $validatedData = $request->validate([
            'currency' => 'required',
            'selected_digits' => 'required|string',
            'amounts' => 'required|array',
            'amounts.*' => 'required|integer|min:1',
            'totalAmount' => 'required|numeric|min:1', // Changed from integer to numeric
            'user_id' => 'required|exists:users,id',
        ]);

        $limitAmount = JackpotLimit::latest()->first()->jack_limit; // Define the limit amount
        $commission_percent = Commission::latest()->first()->commission;
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

            foreach ($request->amounts as $two_digit_string => $sub_amount) {
                $two_digit_id = $two_digit_string === '00' ? 1 : intval($two_digit_string, 10) + 1;

                $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
                    ->where('two_digit_id', $two_digit_id)
                    ->sum('sub_amount');

                //currency auto exchange
                if($request->currency == "baht"){
                    $sub_amount = $sub_amount * $rate;
                }

                if ($totalBetAmountForTwoDigit + $sub_amount <= $limitAmount) {
                    $pivot = new JackpotTwoDigit([
                        'jackpot_id' => $lottery->id,
                        'two_digit_id' => $two_digit_id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false
                    ]);
                    $pivot->save();
                } 
                else {
                    $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
                    $overLimit = $sub_amount - $withinLimit;

                    if ($withinLimit > 0) {
                        $pivotWithin = new JackpotTwoDigit([
                            'jackpot_id' => $lottery->id,
                            'two_digit_id' => $two_digit_id,
                            'sub_amount' => $withinLimit,
                            'prize_sent' => false
                        ]);
                        $pivotWithin->save();
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
            }

            DB::commit();
            session()->flash('SuccessRequest', 'Successfully placed bet.');

            return redirect()->route('user.jackport-play-history')->with('success', 'Data stored successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in store method: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
     public function OnceWeekJackpotHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getUserJackpotDigits($userId);
        return view('jackpot.onec_week_jackpot_history', [
            'displayThreeDigits' => $displayJackpotDigit,
        ]);
    }
}