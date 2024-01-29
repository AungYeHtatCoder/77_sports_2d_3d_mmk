<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Admin\Lottery;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CheckForEarlyEveningWinners implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $twodWiner;

    public function __construct($twodWiner)
    {
        $this->twodWiner = $twodWiner;
    }

    public function handle()
{
    // Check if today is a playing day
    $today = Carbon::today();
    $playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    if (!in_array(strtolower(date('l')), $playDays)) {
        return; // exit if it's not a playing day
    }

    // Find all winning entries using raw SQL
    $winningEntries = DB::table('lottery_two_digit_copy')
        ->join('lotteries', 'lottery_two_digit_copy.lottery_id', '=', 'lotteries.id')
        ->whereRaw('lottery_two_digit_copy.two_digit_id = ?', [$this->twodWiner->prize_no])
        ->whereRaw('lottery_two_digit_copy.prize_sent = 0')
        ->whereRaw('DATE(lottery_two_digit_copy.created_at) = ?', [$today])
        ->select('lottery_two_digit_copy.*') // Select all columns from pivot table
        ->get();

    foreach ($winningEntries as $entry) {
        DB::transaction(function () use ($entry) {
            // Retrieve the lottery for this entry
            $lottery = Lottery::findOrFail($entry->lottery_id);
            $methodToUpdatePivot = 'twoDigits';
            
            // Update user's balance
            $user = $lottery->user;
            $user->balance += $entry->sub_amount * 85;  // Update based on your prize calculation
            $user->save();

            // Update prize_sent in pivot
            $lottery->$methodToUpdatePivot()->updateExistingPivot($entry->two_digit_id, ['prize_sent' => 1]);
        });
    }
}
}