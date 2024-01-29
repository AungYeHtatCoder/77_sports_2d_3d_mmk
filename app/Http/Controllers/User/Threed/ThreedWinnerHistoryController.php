<?php

namespace App\Http\Controllers\User\Threed;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ThreeDigit\Lotto;
use App\Http\Controllers\Controller;

class ThreedWinnerHistoryController extends Controller
{
    public function index()
    {
        $winners = Lotto::whereHas('threedDigits', function ($query) {
            $query->where('prize_sent', 1);
        })->with(['threedDigits' => function ($query) {
            $query->where('prize_sent', 1);
        }])->get();
        return view('three_d.three-d-winner-list', compact('winners'));
        //return response()->json($winners);
    }

    public function OnceMonthThreeDHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayJackpotDigit = User::getUserOneMonthThreeDigits($userId);
        return view('three_d.onec_month_three_d_history', [
            'displayThreeDigits' => $displayJackpotDigit,
        ]);
    }
}