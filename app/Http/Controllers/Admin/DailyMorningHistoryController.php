<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwoDLimit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DailyMorningHistoryController extends Controller
{
    public function TwodDailyMorningHistory()
    {
         $startTime = Carbon::today()->setHour(6)->setMinute(0); // Example: today at 2 PM
        $endTime = Carbon::today()->setHour(12)->setMinute(30); // Example: today at 4 PM

    // Fetch the two digits within the specified time range
    $twoDigits = DB::table('lottery_two_digit_pivot')
        ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
        ->whereBetween('lottery_two_digit_pivot.created_at', [$startTime, $endTime])
        ->select('two_digits.two_digit', 'lottery_two_digit_pivot.sub_amount', 'lottery_two_digit_pivot.prize_sent',  'lottery_two_digit_pivot.created_at') // Select the columns you need
        ->get();

    // Calculate the total sum of sub_amount
    $totalSubAmount = $twoDigits->sum('sub_amount');
    $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();

        return view('admin.two_d.dailymorning_history', [
           'displayTwoDigits' => $twoDigits,
            'totalSubAmount' => $totalSubAmount,
            'twod_limits' => $twod_limits,
        ]);
    }

    public function getAdmin2dDailyMorningHistory()
    {
        $lotteries = (new Lottery)->dailyMorningHistoryForAdmin('5:00', '12:30')->get();

        $totalAmount = 0;
        foreach ($lotteries as $lottery) {
            foreach ($lottery->twoDigits as $twoDigit) {
                $totalAmount += $twoDigit->pivot->sub_amount;
            }
        }

        return [
            'twoDigit' => $lotteries,
            'total_amount' => $totalAmount,
        ];
    }
    public function TwodDailyEveningHistory()
    {
        $startTime = Carbon::today()->setHour(12)->setMinute(0); // Example: today at 2 PM
        $endTime = Carbon::today()->setHour(17)->setMinute(30); // Example: today at 4 PM

    // Fetch the two digits within the specified time range
    $twoDigits = DB::table('lottery_two_digit_pivot')
        ->join('two_digits', 'lottery_two_digit_pivot.two_digit_id', '=', 'two_digits.id')
        ->whereBetween('lottery_two_digit_pivot.created_at', [$startTime, $endTime])
        ->select('two_digits.two_digit', 'lottery_two_digit_pivot.sub_amount', 'lottery_two_digit_pivot.prize_sent',  'lottery_two_digit_pivot.created_at') // Select the columns you need
        ->get();

    // Calculate the total sum of sub_amount
    $totalSubAmount = $twoDigits->sum('sub_amount');
    $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();

        return view('admin.two_d.dailyevening_history', [
           'displayTwoDigits' => $twoDigits,
            'totalSubAmount' => $totalSubAmount,
            'twod_limits' => $twod_limits,
        ]);
    }

    public function getAdmin2dDailyEveningHistory()
    {
        $eveningStart = Carbon::now()->startOfDay()->addHours(12);
        $eveningEnd = Carbon::now()->startOfDay()->addHours(20);
        $lotteries = (new Lottery)->dailyEveningHistoryForAdmin($eveningStart, $eveningEnd)->get();

        $totalAmount = 0;
        foreach ($lotteries as $lottery) {
            foreach ($lottery->twoDigits as $twoDigit) {
                $totalAmount += $twoDigit->pivot->sub_amount;
            }
        }

        return [
            'twoDigit' => $lotteries,
            'total_amount' => $totalAmount,
        ];
    }
}
//    public function TwodDailyMorningHistory()
// {
//     $displayTwoDigits = User::getAdmin2dDailyMorningHistory();
//     $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();
//     return view('admin.two_d.dailymorning_history', [
//         'displayTwoDigits' => $displayTwoDigits,
//         'twod_limits' => $twod_limits,
//     ]);
// }

// public function TwodDailyEveningHistory()
// {
//     $displayTwoDigits = User::getAdmin2dDailyEveningHistory();
//     $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();
//     return view('admin.two_d.dailyeveing_history', [
//         'displayTwoDigits' => $displayTwoDigits,
//         'twod_limits' => $twod_limits,
//     ]);
// }