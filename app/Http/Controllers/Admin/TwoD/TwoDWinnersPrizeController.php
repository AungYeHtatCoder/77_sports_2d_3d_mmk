<?php

namespace App\Http\Controllers\Admin\TwoD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\TwoD\EveningPrize;
use App\Models\Admin\TwoD\MorningPrize;

class TwoDWinnersPrizeController extends Controller
{
    // morning winner history
    public function getMorningPrizeWinnersWithUserInfo()
{
    $winners = DB::table('lottery_two_digit_pivot')
        ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
        ->join('users', 'lotteries.user_id', '=', 'users.id')
        ->where('lottery_two_digit_pivot.prize_sent', '=', 1)
        ->select(
            'lotteries.user_id',
            'users.name',
            'users.phone',
            'lottery_two_digit_pivot.prize_sent',
            'lottery_two_digit_pivot.two_digit_id',
            'lottery_two_digit_pivot.bet_digit',
            'lottery_two_digit_pivot.sub_amount',
            'lottery_two_digit_pivot.prize_sent',
            'lottery_two_digit_pivot.created_at'
        )
        ->get();
        $prizes = MorningPrize::orderBy('id', 'desc')->get();
        $totalPrizeAmount = MorningPrize::sum('prize_amount');

        
    return view('admin.two_d.morning_prize_winner', compact('winners', 'prizes', 'totalPrizeAmount'));
}

    public function storeMorningPrizeWinners(Request $request)
    {
        $winners = DB::table('lottery_two_digit_pivot')
            ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
            ->join('users', 'lotteries.user_id', '=', 'users.id')
            ->where('lottery_two_digit_pivot.prize_sent', '=', 1)
            ->select(
                'lotteries.user_id',
                'users.name',
                'users.phone',
                'lottery_two_digit_pivot.prize_sent',
                'lottery_two_digit_pivot.two_digit_id',
                'lottery_two_digit_pivot.bet_digit',
                'lottery_two_digit_pivot.sub_amount',
                'lottery_two_digit_pivot.prize_sent',
                'lottery_two_digit_pivot.created_at'
            )
            ->get();
        foreach ($winners as $winnerData) {
            MorningPrize::create([
                'user_id' => $winnerData->user_id,
                'user_name' => $winnerData->name,
                'phone' => $winnerData->phone,
                'bet_digit' => $winnerData->bet_digit,
                'sub_amount' => $winnerData->sub_amount,
                'prize_amount' => $winnerData->sub_amount * 85,
                'status' => $winnerData->prize_sent
            ]);
        }

         return redirect()->back()->with('success', 'Fifrst Prize Winners data stored successfully');
    }


    public function updateMorningPrizeWinners(Request $request)
{
    // Retrieve the winners whose prize_sent is 1
    $winners = DB::table('lottery_two_digit_pivot')
        ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
        ->join('users', 'lotteries.user_id', '=', 'users.id')
        ->where('lottery_two_digit_pivot.prize_sent', '=', 1)
        ->select(
            'lottery_two_digit_pivot.id', // Include the primary key of the pivot table
            'users.name',
            'users.phone',
            'lottery_two_digit_pivot.prize_sent',
            'lottery_two_digit_pivot.two_digit_id',
            'lottery_two_digit_pivot.bet_digit',
            'lottery_two_digit_pivot.sub_amount',
            'lottery_two_digit_pivot.created_at'
        )
        ->get();

    // Update the prize_sent column for the winners
    foreach ($winners as $winnerData) {
        DB::table('lottery_two_digit_pivot')
            ->where('id', $winnerData->id) // Use the primary key to identify the row
            ->update(['prize_sent' => 0]);
    }

    return redirect()->back()->with('success', 'Winners data updated successfully');
}

    // evening 
    public function getEveningPrizeWinnersWithUserInfo()
{
    $winners = DB::table('lottery_two_digit_pivot')
        ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
        ->join('users', 'lotteries.user_id', '=', 'users.id')
        ->where('lottery_two_digit_pivot.prize_sent', '=', 1)
        ->select(
            'lotteries.user_id',
            'users.name',
            'users.phone',
            'lottery_two_digit_pivot.prize_sent',
            'lottery_two_digit_pivot.two_digit_id',
            'lottery_two_digit_pivot.bet_digit',
            'lottery_two_digit_pivot.sub_amount',
            'lottery_two_digit_pivot.prize_sent',
            'lottery_two_digit_pivot.created_at'
        )
        ->get();
        $prizes = EveningPrize::orderBy('id', 'desc')->get();
        $totalPrizeAmount = EveningPrize::sum('prize_amount');
        
    return view('admin.two_d.evening_prize_winner', compact('winners', 'prizes', 'totalPrizeAmount'));
}

    public function storeEveningPrizeWinners(Request $request)
    {
        $winners = DB::table('lottery_two_digit_pivot')
            ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
            ->join('users', 'lotteries.user_id', '=', 'users.id')
            ->where('lottery_two_digit_pivot.prize_sent', '=', 1)
            ->select(
                'lotteries.user_id',
                'users.name',
                'users.phone',
                'lottery_two_digit_pivot.prize_sent',
                'lottery_two_digit_pivot.two_digit_id',
                'lottery_two_digit_pivot.bet_digit',
                'lottery_two_digit_pivot.sub_amount',
                'lottery_two_digit_pivot.prize_sent',
                'lottery_two_digit_pivot.created_at'
            )
            ->get();
        foreach ($winners as $winnerData) {
            EveningPrize::create([
                'user_id' => $winnerData->user_id,
                'user_name' => $winnerData->name,
                'phone' => $winnerData->phone,
                'bet_digit' => $winnerData->bet_digit,
                'sub_amount' => $winnerData->sub_amount,
                'prize_amount' => $winnerData->sub_amount * 85,
                'status' => $winnerData->prize_sent
            ]);
        }

         return redirect()->back()->with('success', 'Fifrst Prize Winners data stored successfully');
    }


    public function updateEveningPrizeWinners(Request $request)
{
    // Retrieve the winners whose prize_sent is 1
    $winners = DB::table('lottery_two_digit_pivot')
        ->join('lotteries', 'lottery_two_digit_pivot.lottery_id', '=', 'lotteries.id')
        ->join('users', 'lotteries.user_id', '=', 'users.id')
        ->where('lottery_two_digit_pivot.prize_sent', '=', 1)
        ->select(
            'lottery_two_digit_pivot.id', // Include the primary key of the pivot table
            'users.name',
            'users.phone',
            'lottery_two_digit_pivot.prize_sent',
            'lottery_two_digit_pivot.two_digit_id',
            'lottery_two_digit_pivot.bet_digit',
            'lottery_two_digit_pivot.sub_amount',
            'lottery_two_digit_pivot.created_at'
        )
        ->get();

    // Update the prize_sent column for the winners
    foreach ($winners as $winnerData) {
        DB::table('lottery_two_digit_pivot')
            ->where('id', $winnerData->id) // Use the primary key to identify the row
            ->update(['prize_sent' => 0]);
    }

    return redirect()->back()->with('success', 'Winners data updated successfully');
}


}