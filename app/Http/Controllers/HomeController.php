<?php

namespace App\Http\Controllers;

use App\Models\Admin\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\LotteryMatch;
use App\Models\Jackpot\Jackpot;
use App\Models\ThreeDigit\Lotto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
            /** @var bool $isAdmin */
             $isAdmin = auth()->user()->hasRole('Admin');
            if ($isAdmin) {
            // Daily Total
            $dailyTotal = Lottery::whereDate('created_at', '=', now()->today())->sum('total_amount');

            // Weekly Total
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $weeklyTotal = Lottery::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');

            // Monthly Total
            $monthlyTotal = Lottery::whereMonth('created_at', '=', now()->month)
                ->whereYear('created_at', '=', now()->year)
                ->sum('total_amount');

            // Yearly Total
            $yearlyTotal = Lottery::whereYear('created_at', '=', now()->year)->sum('total_amount');

            // 3D Daily Total
            $three_d_dailyTotal = Lotto::whereDate('created_at', '=', now()->today())->sum('total_amount');

            // 3D Weekly Total
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $three_d_weeklyTotal = Lotto::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');

            // 3D Monthly Total
            $three_d_monthlyTotal = Lotto::whereMonth('created_at', '=', now()->month)
                ->whereYear('created_at', '=', now()->year)
                ->sum('total_amount');

            // 3D Yearly Total
            $three_d_yearlyTotal = Lotto::whereYear('created_at', '=', now()->year)->sum('total_amount');

            // Jackpot Daily Total
            $jackpot_dailyTotal = Jackpot::whereDate('created_at', '=', now()->today())->sum('total_amount');
            // Jackpot Weekly Total
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $jackpot_weeklyTotal = Jackpot::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
            // Jackpot Monthly Total
            $jackpot_monthlyTotal = Jackpot::whereMonth('created_at', '=', now()->month)
                ->whereYear('created_at', '=', now()->year)
                ->sum('total_amount');
            // Jackpot Yearly Total
            $jackpot_yearlyTotal = Jackpot::whereYear('created_at', '=', now()->year)->sum('total_amount');


            $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();
            // Return the totals, you can adjust this part as per your needs
            return view('admin.dashboard', [
                'dailyTotal'   => $dailyTotal,
                'weeklyTotal'  => $weeklyTotal,
                'monthlyTotal' => $monthlyTotal,
                'yearlyTotal'  => $yearlyTotal,
                'three_d_dailyTotal'   => $three_d_dailyTotal,
                'three_d_weeklyTotal'  => $three_d_weeklyTotal,
                'three_d_monthlyTotal' => $three_d_monthlyTotal,
                'three_d_yearlyTotal'  => $three_d_yearlyTotal,
                'jackpot_dailyTotal'   => $jackpot_dailyTotal,
                'jackpot_weeklyTotal'  => $jackpot_weeklyTotal,
                'jackpot_monthlyTotal' => $jackpot_monthlyTotal,
                'jackpot_yearlyTotal'  => $jackpot_yearlyTotal,
                'lottery_matches' => $lottery_matches,
            ]);
        } else {
            $userId = auth()->id(); // Get logged in user's ID
            $playedearlyMorningTwoDigits = User::getUserEarlyMorningTwoDigits($userId);
            $playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
            $playedEarlyEveningTwoDigits = User::getUserEarlyEveningTwoDigits($userId);
            $playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
            $currency = Currency::latest()->first();
            return view('frontend.user-profile', [
                'earlymorningDigits' => $playedearlyMorningTwoDigits,
                'morningDigits' => $playedMorningTwoDigits,
                'earlyeveningDigit' => $playedEarlyEveningTwoDigits,
                'eveningDigits' => $playedEveningTwoDigits,
                'currency' => $currency,
            ]);
        }
    }

    public function UserPlayEveningRecord()
    {
        $userId = auth()->id(); // Get logged in user's ID
        //$playedMorningTwoDigits = User::getUserMorningTwoDigits($userId);
        $playedEveningTwoDigits = User::getUserEveningTwoDigits($userId);
        return view('frontend.user_play_evening', [
            //'morningDigits' => $playedMorningTwoDigits,
            'eveningDigits' => $playedEveningTwoDigits,
        ]);
    }

    public function profile()
    {
        return view('frontend.user-profile');
    }
}