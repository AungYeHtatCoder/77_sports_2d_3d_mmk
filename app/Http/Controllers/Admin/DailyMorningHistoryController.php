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
        $lotteries = (new Lottery)->getLotteriesWithUserAndTwoDigits('5:00', '12:30');
        $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();
        return view('admin.two_d.dailymorning_history', [
            'displayTwoDigits' => $lotteries,
            'twod_limits' => $twod_limits,
        ]);
    }

    public function TwodDailyEveningHistory()
    {
        $displayTwoDigits = User::getAdmin2dDailyEveningHistory();
        $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();
        return view('admin.two_d.dailyeveing_history', [
            'displayTwoDigits' => $displayTwoDigits,
            'twod_limits' => $twod_limits,
        ]);
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