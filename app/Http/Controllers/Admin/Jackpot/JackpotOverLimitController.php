<?php

namespace App\Http\Controllers\Admin\Jackpot;

use Carbon\Carbon;
use App\Models\User\Jackpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jackpot\JackpotWinner;

class JackpotOverLimitController extends Controller
{
     public function overLimit()
    {
        $today = Carbon::now();
        if ($today->day <= 1) {
            $targetDay = 1;
        } else {
            $targetDay = 16;
            // If today is after the 16th, then target the 1st of next month
            if ($today->day > 16) {
                $today->addMonthNoOverflow();
                $today->day = 1;
            }
        }
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        $lotteries = Jackpot::with(['DisplayJackpotDigitsOver', 'lotteryMatch.threedMatchTime'])->orderBy('id', 'desc')->get();
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    
        return view('admin.jackpot.jackpot_over', compact('lotteries', 'prize_no', 'matchTime'));
    }
   

public function SameThreeDigitIDoverLimit()
{
    $today = Carbon::now();
    $targetDay = $today->day <= 1 ? 1 : 16;
    if ($today->day > 16) {
        $today = $today->startOfMonth()->addMonth();
    }

    $matchTime = DB::table('threed_match_times')
        ->whereMonth('match_time', '=', $today->month)
        ->whereYear('match_time', '=', $today->year)
        ->whereDay('match_time', '=', $targetDay)
        ->first();

    // Retrieve the Lotto records along with related over limit three digits
    $lotteries = Jackpot::with(['DisplayJackpotDigitsOver', 'lotteryMatch.threedMatchTime'])
                    ->orderBy('id', 'desc')
                    ->get();

    // Aggregate sub_amounts for each three_digit_id
    $aggregatedData = DB::table('jackpot_over')
                        ->selectRaw('two_digit_id, SUM(sub_amount) as total_sub_amount')
                        ->groupBy('two_digit_id')
                        ->pluck('total_sub_amount', 'two_digit_id');

    $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())
                           ->orderBy('id', 'desc')
                           ->first();

    return view('admin.jackpot.same_jackpot_over', compact('lotteries', 'prize_no', 'matchTime', 'aggregatedData'));
}

}