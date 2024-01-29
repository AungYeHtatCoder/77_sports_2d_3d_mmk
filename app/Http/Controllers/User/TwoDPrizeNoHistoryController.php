<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Admin\TwodWiner;
use App\Http\Controllers\Controller;

class TwoDPrizeNoHistoryController extends Controller
{
    public function index()
    {
        $morningData = TwodWiner::where('session', 'morning')->orderBy('id', 'desc')->get();
        $eveningData = TwodWiner::where('session', 'evening')->orderBy('id', 'desc')->get();
        return view('frontend.morning_prize_no_history', compact('morningData', 'eveningData'));
    }
}