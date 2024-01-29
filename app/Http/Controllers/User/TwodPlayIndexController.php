<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lottery;
use Illuminate\Http\Request;
use App\Models\Admin\TwodWiner;
use App\Models\Admin\LotteryMatch;
use App\Http\Controllers\Controller;

class TwodPlayIndexController extends Controller
{
    public function index()
    {
        return view('frontend.two_d.twod');
    }
    public function TwoDigitOnceMonthHistory()
{
    $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getUserOneMonthTwoDigits($userId);
        return view('two_d.onec_month_two_d_history', [
            'displayThreeDigits' => $displayJackpotDigit,
        ]);
}

}