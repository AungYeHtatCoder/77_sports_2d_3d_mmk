<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPlayTwoDHistoryRecordController extends Controller
{
    public function MorningPlayHistoryRecord()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
        //$playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
        return view('frontend.two_d.twod_history', [
            'morningDigits' => $playedMorningTwoDigits,
            //'eveningDigits' => $playedEveningTwoDigits,
        ]);
    }

    public function EveningPlayHistoryRecord()
    {
        $userId = auth()->id(); // Get logged in user's ID
        //$playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
        $playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
        return view('two_d.evening-history-record', [
            // 'morningDigits' => $playedMorningTwoDigits,
            'eveningDigits' => $playedEveningTwoDigits,
        ]);
    }

    public function twodHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $playedearlyMorningTwoDigits = User::getUserEarlyMorningTwoDigits($userId);
        $playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
        $playedEarlyEveningTwoDigits = User::getUserEarlyEveningTwoDigits($userId);
        $playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
        return view('frontend.two_d.twod_history', [
            'earlymorningDigits' => $playedearlyMorningTwoDigits,
            'morningDigits' => $playedMorningTwoDigits,
            'earlyeveningDigit' => $playedEarlyEveningTwoDigits,
            'eveningDigits' => $playedEveningTwoDigits,
        ]);
    }
}
