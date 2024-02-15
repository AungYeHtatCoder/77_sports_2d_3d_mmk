<?php

namespace App\Services;

use App\Models\Lottery;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\TwoDLimit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\LotteryTwoDigitPivot;
use Illuminate\Support\Facades\Auth;

class TwoDService
{
    public function play($totalAmount, array $amounts)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            if ($user->balance < $totalAmount) {
                // throw new \Exception('Insufficient funds.');
                // return response()->json(['message' => 'လက်ကျန်ငွေ မလုံလောက်ပါ။'], 401);
                return "Insufficient funds.";
            }

            foreach ($amounts as $amount) {
                $this->preProcessAmountCheck($amount);
            }

            $lottery = Lottery::create([
                'pay_amount' => $totalAmount,
                'total_amount' => $totalAmount,
                'user_id' => $user->id,
                'session' => $this->determineSession(),
            ]);

            foreach ($amounts as $amount) {
                $this->processAmount($amount, $lottery->id);
            }
            /** @var \App\Models\User $user */
            $user->balance -= $totalAmount;
            $user->save();

            DB::commit();

            // return ['message' => 'Bet placed successfully'];
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in TwoDService play method: ' . $e->getMessage());
            //return ['error' => $e->getMessage()];
            // Rethrow the exception to be handled by the global exception handler
            // 401 is the status code for Unauthorized
            return response()->json(['message'=> $e->getMessage()], 401);
        }
    }

     protected function preProcessAmountCheck($amount)
    {
        $twoDigit = TwoDigit::where('two_digit', sprintf('%02d', $amount['num']))->firstOrFail();
        $break = TwoDLimit::latest()->first()->two_d_limit;
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                                       ->where('two_digit_id', $twoDigit->id)
                                       ->sum('sub_amount');
        $subAmount = $amount['amount'];

        if ($totalBetAmountForTwoDigit + $subAmount > $break) {
            return "overlimit";
            // throw new \Exception('The bet amount exceeds the limit for two-digit number ' . $twoDigit->two_digit);
        }
    }

    protected function processAmount($amount, $lotteryId)
    {
        $twoDigit = TwoDigit::where('two_digit', sprintf('%02d', $amount['num']))->firstOrFail();

        $break = TwoDLimit::latest()->first()->two_d_limit;
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                                       ->where('two_digit_id', $twoDigit->id)
                                       ->sum('sub_amount');
        $subAmount = $amount['amount'];

        if ($totalBetAmountForTwoDigit + $subAmount <= $break) {
            LotteryTwoDigitPivot::create([
                'lottery_id' => $lotteryId,
                'two_digit_id' => $twoDigit->id,
                'sub_amount' => $subAmount,
            ]);
        } else {
            // Handle the case where the bet exceeds the limit
            return "overlimit";
            // throw new \Exception('The bet amount exceeds the limit for two-digit number ' . $twoDigit->two_digit);
        }
    }

    private function determineSession()
    {
        return date('H') < 12 ? 'morning' : 'evening';
    }
}