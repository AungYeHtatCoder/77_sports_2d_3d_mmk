<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwoDLimit;
use App\Http\Controllers\Controller;

class DailyMorningHistoryController extends Controller
{
    public function TwodDailyMorningHistory()
    {
        $lotteryData = $this->getAdmin2dDailyMorningHistory();
        $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();

        return view('admin.two_d.dailymorning_history', [
            'displayTwoDigits' => $lotteryData['twoDigit'],
            'total_amount' => $lotteryData['total_amount'],
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
        $lotteryData = $this->getAdmin2dDailyEveningHistory();
        $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();

        return view('admin.two_d.dailyevening_history', [
            'displayTwoDigits' => $lotteryData['twoDigit'],
            'total_amount' => $lotteryData['total_amount'],
            'twod_limits' => $twod_limits,
        ]);
    }

    public function getAdmin2dDailyEveningHistory()
    {
        $lotteries = (new Lottery)->dailyEveningHistoryForAdmin('12:00', '17:30')->get();

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