<?php

namespace App\Http\Controllers\Api\V1\TwoD;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\TwoD\EveningPrize;
use App\Models\Admin\TwoD\MorningPrize;

class TwoDPrizeController extends Controller
{
    

    public function MorningPrizeWinnerForApk()
    {
    try {
        $userId = Auth::id(); // Retrieve the authenticated user's ID

        // Get the current date
        $currentDate = Carbon::now()->startOfDay();

        // Define start and end times for the current day
        $startTime = $currentDate->copy()->setHour(12)->setMinute(0)->setSecond(0); // 12:00 PM
        $endTime = $currentDate->copy()->setHour(16)->setMinute(15)->setSecond(0);   // 4:30 PM

        // Fetch prize winners for the current user between start and end time
        $winners = MorningPrize::where('user_id', $userId)
            ->whereBetween('created_at', [$startTime, $endTime])
            ->with('user') // Eager load the user relationship
            ->orderBy('id', 'desc')
            ->get();

        // Calculate total prize amount for the current user
        $totalPrizeAmount = MorningPrize::where('user_id', $userId)
            ->whereBetween('created_at', [$startTime, $endTime])
            ->sum('prize_amount');

        return response()->json([
            'success' => true,
            'message' => 'Prize winners fetched successfully.',
            'winners' => $winners,
            'totalPrizeAmount' => $totalPrizeAmount
        ], 200);
    } catch (\Exception $e) {
        // Log the error or handle it appropriately
        return response()->json(['error' => 'Something went wrong while fetching prize winners.'], 500);
    }
}

    public function EveningPrizeWinnerForApk()
    {
    try {
        $userId = Auth::id(); // Retrieve the authenticated user's ID

        // Get the current date
        $currentDate = Carbon::now()->startOfDay();

        // Define start and end times for the current day
        $startTime = $currentDate->copy()->setHour(16)->setMinute(30)->setSecond(0); // 12:00 PM
        $endTime = $currentDate->copy()->setHour(24)->setMinute(0)->setSecond(0);   // 4:30 PM

        // Fetch prize winners for the current user between start and end time
        $winners = MorningPrize::where('user_id', $userId)
            ->whereBetween('created_at', [$startTime, $endTime])
            ->with('user') // Eager load the user relationship
            ->orderBy('id', 'desc')
            ->get();

        // Calculate total prize amount for the current user
        $totalPrizeAmount = EveningPrize::where('user_id', $userId)
            ->whereBetween('created_at', [$startTime, $endTime])
            ->sum('prize_amount');

        return response()->json([
            'success' => true,
            'message' => 'Prize winners fetched successfully.',
            'winners' => $winners,
            'totalPrizeAmount' => $totalPrizeAmount
        ], 200);
    } catch (\Exception $e) {
        // Log the error or handle it appropriately
        return response()->json(['error' => 'Something went wrong while fetching prize winners.'], 500);
    }
}


    // public function MorningPrizeWinner()
    // {
    //     try {
    //         // Define start and end time for the current day
    //         $startTime = Carbon::createFromTime(12, 0, 0);  // 12:00 PM
    //         $endTime = Carbon::createFromTime(16, 30, 0);   // 4:30 PM
            
    //         // Fetch prize winners between start and end time
    //         $winners = MorningPrize::with('user')
    //             ->whereBetween('created_at', [$startTime, $endTime])
    //             ->orderBy('id', 'desc')
    //             ->get();
            
    //         // Calculate total prize amount
    //         $totalPrizeAmount = $winners->sum('prize_amount');
            
    //         return response()->json([ 
    //             'success' => true,
    //             'message' => 'Prize winners fetched successfully.',
    //             'winners' => $winners,
    //             'totalPrizeAmount' => $totalPrizeAmount
    //         ], 200);
    //     } catch (\Exception $e) {
    //         // Log the error or handle it appropriately
    //         return response()->json(['error' => 'Something went wrong while fetching prize winners.'], 500);
    //     }
    // }

    public function EveningPrizeWinner()
{
    try {
        $winners = EveningPrize::with('user')->orderBy('id', 'desc')->get();
        $totalPrizeAmount = EveningPrize::sum('prize_amount');
        
        return response()->json([
            'success' => true,
            'message' => 'Prize winners fetched successfully.',
            'winners' => $winners,
            'totalPrizeAmount' => $totalPrizeAmount
        ], 200);
    } catch (\Exception $e) {
        // Log the error or handle it appropriately
        return response()->json(['error' => 'Something went wrong while fetching prize winners.'], 500);
    }
}

    /* 
        use Carbon\Carbon;

public function MorningPrizeWinner()
{
    try {
        // Define start and end time for the current day
        $startTime = Carbon::createFromTime(12, 0, 0);  // 12:00 PM
        $endTime = Carbon::createFromTime(16, 30, 0);   // 4:30 PM
        
        // Subtract one day to include data from the previous day
        $startTime->subDay();
        $endTime->subDay();
        
        // Fetch prize winners between start and end time
        $winners = MorningPrize::with('user')
            ->whereBetween('created_at', [$startTime, $endTime])
            ->orderBy('id', 'desc')
            ->get();
        
        // Calculate total prize amount
        $totalPrizeAmount = $winners->sum('prize_amount');
        
        return response()->json([ 
            'success' => true,
            'message' => 'Prize winners fetched successfully.',
            'winners' => $winners,
            'totalPrizeAmount' => $totalPrizeAmount
        ], 200);
    } catch (\Exception $e) {
        // Log the error or handle it appropriately
        return response()->json(['error' => 'Something went wrong while fetching prize winners.'], 500);
    }
}

    */

}