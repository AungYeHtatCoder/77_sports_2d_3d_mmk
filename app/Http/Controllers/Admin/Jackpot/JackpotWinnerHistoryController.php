<?php

namespace App\Http\Controllers\Admin\Jackpot;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JackpotWinnerHistoryController extends Controller
{
    public function getWinnersHistoryForAdmin()
    {
        $oneMonthAgo = Carbon::now()->subMonth();
        $winners = DB::table('jackpot_two_digit')
        ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
        ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
        ->join('users', 'jackpots.user_id', '=', 'users.id')
        ->join('jackpot_winners', 'two_digits.two_digit', '=', 'jackpot_winners.prize_no')
        ->whereDate('jackpot_winners.created_at', '>=', $oneMonthAgo)
        ->groupBy(
            'jackpots.user_id', 
            'users.name',
            'users.profile',
            'users.phone',
            'jackpot_two_digit.sub_amount', 
            'jackpot_two_digit.prize_sent',
            'jackpots.total_amount', 
            'jackpot_winners.prize_no', 
            'jackpot_winners.created_at',  
        )
        ->select(
            'jackpots.user_id', 
            'users.name',
            'users.profile',
            'users.phone',
            'jackpot_two_digit.sub_amount',
            'jackpot_two_digit.prize_sent',
            'jackpots.total_amount',
            'jackpot_winners.prize_no', 
            'jackpot_winners.created_at', 
         DB::raw('jackpot_two_digit.sub_amount * 85 as prize_amount')
        )
        ->orderBy('prize_amount', 'desc') // Add this line to sort by prize_amount in descending order
        ->get();
    // Update the prize_sent date for each winner
     foreach ($winners as $winner) {
        $this->updatePrizeSentDate($winner->user_id); // Make sure user_id is the ID of the winner
    }

        return view('admin.jackpot.winner_history', compact('winners'));
    }

     public function updatePrizeSentDate($winnerId)
    {
        // Find the lottery_two_digit_pivot record
        $lotteryTwoDigitPivot = DB::table('jackpot_two_digit')->where('jackpot_id', $winnerId)->first();

        // Check if the record exists
        if (!$lotteryTwoDigitPivot) {
            return redirect()->back()->with('error', 'Record not found!');
        }

        // Update the prize_sent field to true
        DB::table('jackpot_two_digit')
            ->where('jackpot_id', $winnerId)
            ->update(['prize_sent' => true]);

        return redirect()->back()->with('success', 'Prize sent date updated successfully!');
    }


    // public function getWinnersHistoryForAdminApi()
    // {
    //     $oneMonthAgo = Carbon::now()->subMonth();
    //     $winners = DB::table('jackpot_two_digit')
    //     ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
    //     ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
    //     ->join('users', 'jackpots.user_id', '=', 'users.id')
    //     ->join('jackpot_winners', 'two_digits.two_digit', '=', 'jackpot_winners.prize_no')
    //     ->whereDate('jackpot_winners.created_at', '>=', $oneMonthAgo)
    //     ->groupBy(
    //         'jackpots.user_id', 
    //         'users.name',
    //         'users.profile',
    //         'users.phone',
    //         'jackpot_two_digit.sub_amount', 
    //         'jackpot_two_digit.prize_sent',
    //         'jackpots.total_amount', 
    //         'jackpot_winners.prize_no', 
    //         'jackpot_winners.created_at',  
    //     )
    //     ->select(
    //         'jackpots.user_id', 
    //         'users.name',
    //         'users.profile',
    //         'users.phone',
    //         'jackpot_two_digit.sub_amount',
    //         'jackpot_two_digit.prize_sent',
    //         'jackpots.total_amount',
    //         'jackpot_winners.prize_no', 
    //         'jackpot_winners.created_at', 
    //         DB::raw('jackpot_two_digit.sub_amount * 85 as prize_amount')
    //     )
    //     ->get();

    //     // Update the prize_sent date for each winner
    //     foreach ($winners as $winner) {
    //         $this->updatePrizeSentDateApi($winner->user_id); // Make sure user_id is the ID of the winner
    //     }

    //     return response()->json($winners);
    // }
    public function getWinnersHistoryForAdminApi()
    {
        $oneMonthAgo = Carbon::now()->subMonth();
        $winners = DB::table('jackpot_two_digit')
        ->join('two_digits', 'jackpot_two_digit.two_digit_id', '=', 'two_digits.id')
        ->join('jackpots', 'jackpot_two_digit.jackpot_id', '=', 'jackpots.id')
        ->join('users', 'jackpots.user_id', '=', 'users.id')
        ->join('jackpot_winners', 'two_digits.two_digit', '=', 'jackpot_winners.prize_no')
        ->whereDate('jackpot_winners.created_at', '>=', $oneMonthAgo)
        ->groupBy(
            'jackpots.user_id', 
            'users.name',
            'users.profile',
            'users.phone',
            'jackpot_two_digit.sub_amount', 
            'jackpot_two_digit.prize_sent',
            'jackpots.total_amount', 
            'jackpot_winners.prize_no', 
            'jackpot_winners.created_at',  
        )
        ->select(
            'jackpots.user_id', 
            'users.name',
            'users.profile',
            'users.phone',
            'jackpot_two_digit.sub_amount',
            'jackpot_two_digit.prize_sent',
            'jackpots.total_amount',
            'jackpot_winners.prize_no', 
            'jackpot_winners.created_at', 
            DB::raw('jackpot_two_digit.sub_amount * 85 as prize_amount')
        )
        ->orderBy('prize_amount', 'desc') // Add this line to sort by prize_amount in descending order
        ->get();

        // Update the prize_sent date for each winner
        foreach ($winners as $winner) {
            $this->updatePrizeSentDateApi($winner->user_id); // Make sure user_id is the ID of the winner
        }

        return response()->json($winners);
    }
    public function updatePrizeSentDateApi($winnerId)
    {
        // Find the lottery_two_digit_pivot record
        $lotteryTwoDigitPivot = DB::table('jackpot_two_digit')->where('jackpot_id', $winnerId)->first();

        // Check if the record exists
        if (!$lotteryTwoDigitPivot) {
            return response()->json(['message' => 'Record not found!'], 404);
        }

        // Update the prize_sent field to true
        DB::table('jackpot_two_digit')
            ->where('jackpot_id', $winnerId)
            ->update(['prize_sent' => true]);

        return response()->json(['message' => 'Prize sent date updated successfully!'], 200);
    }

}