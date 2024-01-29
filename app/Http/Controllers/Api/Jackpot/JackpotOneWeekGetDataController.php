<?php

namespace App\Http\Controllers\Api\Jackpot;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Jackpot\Jackpot;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jackpot\JackpotWinner;

class JackpotOneWeekGetDataController extends Controller
{
   
    public function OnceMonthJackpotHistory()
    {
        $userId = auth()->user()->id;
        $displayJackpotDigit = User::getUserOneMonthJackpotDigits($userId);
        return response()->json([
            'displayThreeDigits' => $displayJackpotDigit,
        ]);
    }
    public function index()
    {
         try {
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
        $user_id = auth()->user()->id;
        $matchTime = DB::table('threed_match_times')
            ->whereMonth('match_time', '=', $today->month)
            ->whereYear('match_time', '=', $today->year)
            ->whereDay('match_time', '=', $targetDay)
            ->first();
        // i want to show only once week jackpot history start from 1st to 17th and 16th to 2st
        $start = Carbon::now()->startOfMonth();
        $end_in_st_17 = Carbon::now()->startOfMonth()->addDays(16);
        $statr_in_nd_2 = Carbon::now()->startOfMonth()->addDays(17);
        $end = Carbon::now()->endOfMonth();
        $lotteries = Jackpot::with(['JackpotDigits', 'lotteryMatch.threedMatchTime'])
        ->where('user_id', $user_id)
        ->whereBetween('created_at', [$start, $end_in_st_17])
        ->orWhere(function ($query) use ($user_id, $statr_in_nd_2, $end) {
            $query->where('user_id', $user_id)
                  ->whereBetween('created_at', [$statr_in_nd_2, $end]);
        })
        ->orderBy('id', 'desc')->get();
        $prize_no = JackpotWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

        return response()->json([
            'success' => true,
            'message' => 'Data fetched successfully',
            'lotteries' => $lotteries,
            'prize_no' => $prize_no,
            'matchTime' => $matchTime
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage()
        ], 401);
    }
}
}