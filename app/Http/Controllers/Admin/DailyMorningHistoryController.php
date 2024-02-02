<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\TwoDLimit;

class DailyMorningHistoryController extends Controller
{
   public function TwodDailyMorningHistory()
{
    $displayTwoDigits = User::getAdmin2dDailyMorningHistory();
    $twod_limits = TwoDLimit::orderBy('id', 'desc')->first();
    return view('admin.two_d.dailymorning_history', [
        'displayTwoDigits' => $displayTwoDigits,
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