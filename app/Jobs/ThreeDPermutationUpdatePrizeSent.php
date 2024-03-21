<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Lotto;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ThreeDPermutationUpdatePrizeSent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
   protected $threedWinner;

    public function __construct($threedWinner)
    {
        $this->threedWinner = $threedWinner;
    }

    public function handle(): void
    {
        if (!$this->isPlayingDay()) {
            return;
        }

        $prize_no_str = (string) $this->threedWinner->prize_no;
        $permutations = $this->generatePermutationsExcludeOriginal($prize_no_str);

        foreach ($permutations as $permutation) {
            $this->processWinningEntries($permutation);
        }
    }

    protected function isPlayingDay(): bool
    {
        $playDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return in_array(Carbon::now()->englishDayOfWeek, $playDays);
    }

    protected function generatePermutationsExcludeOriginal($original) {
        $permutations = $this->permutation($original, $original);
        if (($key = array_search($original, $permutations)) !== false) {
            unset($permutations[$key]);
        }
        return array_values($permutations);
    }

    protected function permutation($str, $original) {
        if (strlen($str) <= 1) {
            return [$str];
        }

        $result = [];
        for ($i = 0; $i < strlen($str); $i++) {
            $char = $str[$i];
            $remainingChars = substr($str, 0, $i) . substr($str, $i + 1);
            foreach ($this->permutation($remainingChars, $original) as $subPerm) {
                $perm = $char . $subPerm;
                if (!in_array($perm, $result)) {
                    $result[] = $perm;
                }
            }
        }

        return $result;
    }

    protected function processWinningEntries($permutation)
    {
        $today = Carbon::today();

        $winningEntries = DB::table('lotto_three_digit_pivot')
            ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
            ->where('lotto_three_digit_pivot.bet_digit', $permutation)
            ->where('lotto_three_digit_pivot.prize_sent', 0)
            ->whereDate('lotto_three_digit_pivot.created_at', $today)
            ->select('lotto_three_digit_pivot.*')
            ->get();

        foreach ($winningEntries as $entry) {
            DB::transaction(function () use ($entry) {
                $lottery = Lotto::findOrFail($entry->lotto_id);
                $user = $lottery->user;
                $user->balance += $entry->sub_amount * 0; 
                $user->save();

                $lottery->Prizes()->updateExistingPivot($entry->three_digit_id, ['prize_sent' => 2]);
            });
        }
    }
}