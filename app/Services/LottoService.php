<?php 

namespace App\Services;

use App\Models\Lotto;
use App\Models\ThreeDigit;
use App\Models\Admin\ThreeDDLimit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ThreeDigit\LotteryThreeDigitPivot;

class LottoService
{
    public function play($totalAmount, $amounts)
    {
        // Begin Database Transaction
        DB::beginTransaction();

        try {
            // Retrieve the authenticated user
            $user = Auth::user();
            $user->balance -= $totalAmount;

            // Check if the user's balance is sufficient
            if ($user->balance < 0) {
                throw new \Exception('Insufficient funds.');
            }

            // Save the user with the new balance
        /** @var \App\Models\User $user */
            $user->save();

            // Create a new lottery record
            $lottery = Lotto::create([
                'total_amount' => $totalAmount,
                'user_id' => $user->id,
            ]);

            // Process each amount
            foreach ($amounts as $item) {
                $this->processAmount($item, $lottery);
            }

            // Commit the transaction
            DB::commit();
            
            // Return the lottery data or other success indication
            return $lottery;
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();
            Log::error('Error in LottoService play method: ' . $e->getMessage());

            // Rethrow the exception to be handled by the global exception handler
            throw $e;
        }
    }

    protected function processAmount($item, $lottery)
    {
        $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
        $sub_amount = $item['amount'];

        // Find the corresponding three digit record
        $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();

        // Calculate the total bet amount for the three_digit
        $totalBetAmount = DB::table('lotto_three_digit_copy')
                            ->where('three_digit_id', $three_digit->id)
                            ->sum('sub_amount');

        // Check if the limit is exceeded
        $break = ThreeDDLimit::latest()->first()->three_d_limit;
        if ($totalBetAmount + $sub_amount > $break) {
            throw new \Exception('The bet amount exceeds the limit.');
        }

        // Create a pivot record for a valid bet
        $pivot = new LotteryThreeDigitPivot([
            'lotto_id' => $lottery->id,
            'three_digit_id' => $three_digit->id,
            'sub_amount' => $sub_amount,
            'prize_sent' => false,
            'currency' => 'mmk'
        ]);
        $pivot->save();

        // Perform additional actions if necessary
        // ...
    }
}