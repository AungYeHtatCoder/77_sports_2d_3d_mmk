<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Matching;
use App\Models\Admin\BetLottery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\BetLotteryMatchingCopy;
class ThreeDigitPlayController extends Controller
{

     public function ThreeDigitPlaystore(Request $request)
    {
        $validatedData = $request->validate([
            'digit' => 'required|array',
            'sub_amount' => 'required|array',
            'sub_amount.*' => 'required|integer|min:100|max:5000',
            'total_amount' => 'required|numeric|min:100',
            'user_id' => 'required|exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            $user = $this->deductUserBalance($request->total_amount);
            $lottery = $this->createLottery($request->total_amount, $request->user_id);
            $this->attachDigitsToLottery($lottery, $request->digit, $request->input('sub_amount'), $request->input('match_time'));

            DB::commit();
            session()->flash('SuccessRequest', 'Your betting was successful.');
            return back()->with(['success' => 'Digits played successfully.', 'new_balance' => $user->balance]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error: ' . $e->getMessage());
            return back();
        }
    }

    private function deductUserBalance($totalAmount)
    {
        $user = Auth::user();
        $user->balance -= $totalAmount;

        if ($user->balance < 0) {
            throw new \Exception('Not enough balance.');
        }

        $user->save();

        return $user;
    }

    private function createLottery($totalAmount, $userId)
    {
        return BetLottery::create([
            'total_amount' => $totalAmount,
            'user_id' => $userId,
            'lottery_match_id' => 2, // This should be dynamically determined or validated
        ]);
    }

    private function attachDigitsToLottery($lottery, $digits, $subAmounts, $matchTimeId)
    {
        foreach ($digits as $key => $digit) {
            $totalBetAmountForDigit = DB::table('bet_lottery_matching_copy')
                ->where('digit_entry', $digit)
                ->sum('sub_amount');

            if ($totalBetAmountForDigit + $subAmounts[$key] > 5000) {
                throw new \Exception("The bet amount limit for digit {$digit} is exceeded.");
            }

            $matchTime = Matching::find($matchTimeId);
            if (!$matchTime) {
                throw new \Exception('Invalid match time.');
            }

            // $lottery->matchings()->attach($matchTimeId, [
            //     'digit_entry' => $digit,
            //     'sub_amount' => $subAmounts[$key],
            //     'prize_sent' => false,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ]);
            $pivot = new BetLotteryMatchingCopy();
            $pivot->matching_id = $matchTimeId;
            $pivot->bet_lottery_id = $lottery->id;
            $pivot->digit_entry = $digit;
            $pivot->sub_amount = $subAmounts[$key];
            $pivot->prize_sent = false;
            $pivot->created_at = Carbon::now();
            $pivot->updated_at = Carbon::now();
            $pivot->save();
            
        }
    }
    //     public function ThreeDigitPlaystore(Request $request)
// {
//     // $request->validate([
//     //     'digit' => 'required|array',
//     //     'sub_amount' => 'required|array',
//     //     'sub_amount.*' => 'required|integer|min:100|max:5000',
//     //     'total_amount' => 'required|numeric|min:100',
//     //     'user_id' => 'required|exists:users,id',
//     //     //'matching_id' => 'required|exists:matchings,id',
//     // ]);
//     //dd($request->all());
//     // Log::info($request->all());
//     // DB::beginTransaction();

//     try {
//         $user = Auth::user();
//         $user->balance -= $request->total_amount;

//         if ($user->balance < 0) {
//             throw new \Exception('Not enough balance.');
//         }

//         $user->save();

//         $betLottery = BetLottery::create([
//             'total_amount' => $request->total_amount,
//             'user_id' => $user->id,
//             'lottery_match_id' => $request->matching_id,
//         ]);

//         foreach ($request->digit as $key => $digit) {
//             $subAmount = $request->sub_amount[$key];
//             $existingAmount = DB::table('bet_lottery_matching')
//                 ->where('digit_entry', $digit)
//                 ->where('matching_id', $request->matching_id)
//                 ->sum('sub_amount');

//             if ($existingAmount + $subAmount > 5000) {
//                 throw new \Exception("The bet amount limit for digit {$digit} is exceeded.");
//             }

//             $betLottery->matchings()->attach($request->matching_id, [
//                 'digit_entry' => $digit,
//                 'sub_amount' => $subAmount,
//                 'prize_sent' => false,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
//         }

//         DB::commit();
//         return back()->with('success', 'Your betting was successful. New balance: ' . $user->balance);

//     } catch (\Exception $e) {
//         DB::rollBack();
//         return back()->withErrors('error', $e->getMessage());
//     }
// }

// public function ThreeDigitPlaystore(Request $request)
// {
//         $validatedData = $request->validate([
//         'digit' => 'required|array',
//         'sub_amount' => 'required|array',
//         'sub_amount.*' => 'required|integer|min:100|max:5000',
//         'total_amount' => 'required|numeric|min:100',
//         'user_id' => 'required|exists:users,id',
//         //'match_time_id' => 'required|exists:matchings,id', // Assuming match_time_id is provided
//     ]);

//     DB::beginTransaction();

//     try {
//         $user = $this->deductUserBalance($request->total_amount);
//         $betLottery = $this->createBetLottery($request->total_amount, $request->user_id, $request->matching_id);
//         $this->attachDigitsToBetLottery($betLottery, $request->digit, $request->sub_amount, $request->matching_id);

//         DB::commit();
//         session()->flash('SuccessRequest', 'Your betting was successful.');
//         return back()->with(['success' => 'Digits played successfully.', 'new_balance' => $user->balance]);
        
//     } catch (\Exception $e) {
//         DB::rollBack();
//         session()->flash('error', 'Error: ' . $e->getMessage());
//         return back();
//     }
// }

// private function deductUserBalance($totalAmount)
// {
//     $user = Auth::user();
//     $user->balance -= $totalAmount;

//     if ($user->balance < 0) {
//         throw new \Exception('Not enough balance.');
//     }

//     $user->save();

//     return $user;
// }

// private function createBetLottery($totalAmount, $userId, $matchTimeId)
// {
//     return BetLottery::create([
//         'total_amount' => $totalAmount,
//         'user_id' => $userId,
//         'lottery_match_id' => $matchTimeId,
//     ]);
// }

// private function attachDigitsToBetLottery($betLottery, $digits, $subAmounts, $matchTimeId)
// {
//     foreach ($digits as $key => $digit) {
//         $totalBetAmountForDigit = DB::table('bet_lottery_matching')
//             ->where('digit_entry', $digit)
//             ->where('matching_id', $matchTimeId)
//             ->sum('sub_amount');

//         if ($totalBetAmountForDigit + $subAmounts[$key] > 5000) {
//             throw new \Exception("The bet amount limit for digit {$digit} is exceeded.");
//         }

//         $betLottery->matchings()->attach($matchTimeId, [
//             'digit_entry' => $digit,
//             'sub_amount' => $subAmounts[$key],
//             'prize_sent' => false,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }
// }

}