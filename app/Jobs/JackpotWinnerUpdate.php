<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Models\Jackpot\Jackpot;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class JackpotWinnerUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $twodWiner;

    public function __construct($twodWiner)
    {
        $this->twodWiner = $twodWiner;
    }

    public function handle()
{
    //\Log::info('Job started for TwodWiner with prize_no: ' . $this->twodWiner->prize_no);

    $today = Carbon::today();
    //\Log::info("Today's date: " . $today->toDateString());
    // Convert prize_no to two_digit_id
    $two_digit_id = $this->twodWiner->prize_no === '00' ? 1 : intval($this->twodWiner->prize_no, 10) + 1;

    $winningEntries = DB::table('jackpot_two_digit')
        ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
        ->where('jackpot_two_digit.two_digit_id', $two_digit_id) // Use the calculated two_digit_id
        ->where('jackpot_two_digit.prize_sent', false)
        ->whereDate('jackpot_two_digit.created_at', $today)
        ->select('jackpot_two_digit.*')
        ->get();
    foreach ($winningEntries as $entry) {
        DB::transaction(function () use ($entry) {
            $lottery = Jackpot::findOrFail($entry->jackpot_id);
            // $user = $lottery->user;
            // $user->balance += $entry->sub_amount * 85; // Assuming the prize multiplier is 85
            // $user->save();

            // Update prize_sent to true for the winning entry
            $lottery->twoDigits()->updateExistingPivot($entry->two_digit_id, ['prize_sent' => 1]);
        });
    }
}

}