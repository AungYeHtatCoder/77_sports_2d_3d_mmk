<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WinnerHistoryController extends Controller
{
    public function winnerHistory()
    {
        $oneMonthAgo = Carbon::now()->subMonth();
        $winners = DB::table('lottery_two_digit_pivot')
            ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
            ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
            ->join('users', 'lotteries.user_id', '=', 'users.id')
            ->join('twod_winers', 'two_digits.two_digit', '=', 'twod_winers.prize_no')
            ->whereDate('twod_winers.created_at', '>=', $oneMonthAgo)
            ->groupBy(
                'lotteries.user_id',
                'twod_winers.session',
                'users.name',
                'users.profile',
                'users.phone',
                'lottery_two_digit_pivot.sub_amount',
                'lotteries.total_amount',
                'twod_winers.prize_no',
                'twod_winers.created_at',
            )
            ->select(
                'lotteries.user_id',
                'twod_winers.session',
                'users.name',
                'users.profile',
                'users.phone',
                'lottery_two_digit_pivot.sub_amount',
                'lotteries.total_amount',
                'twod_winers.prize_no',
                'twod_winers.created_at',
                DB::raw('lottery_two_digit_pivot.sub_amount * 85 as prize_amount')
            )
            ->get();

        return view('frontend.two_d.twod_winner', compact('winners'));
    }
}
