<?php

namespace App\Http\Controllers\Admin\ThreeD;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lotto;
use App\Http\Controllers\Controller;
use App\Models\ThreeDigit\ThreeWinner;

class ThreeDWinnerController extends Controller
{
    public function index()
    {
        $lotteries = Lotto::with('threedDigitWinner')->get();

        $prize_no_morning = ThreeWinner::whereDate('created_at', Carbon::today())
                                     ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(10), Carbon::now()->startOfDay()->addHours(24)])
                                     ->orderBy('id', 'desc')
                                     ->first();
       
                                     $prize_no = ThreeWinner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        return view('admin.three_d.three_d_winner', compact('lotteries', 'prize_no_morning', 'prize_no'));
    }
}