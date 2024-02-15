<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\TwoDLimit;

class TwoDRemainingAmountController extends Controller
{
    

public function index()
{
    try {
        $twoDigits = TwoDigit::all();

        // Calculate remaining amounts for each two-digit
        $remainingAmounts = [];
        foreach ($twoDigits as $digit) {
            $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                ->where('two_digit_id', $digit->id)
                ->sum('sub_amount');
            $limits = TwoDLimit::latest()->first()->two_d_limit;

            $remainingAmounts[$digit->id] = $limits - $totalBetAmountForTwoDigit; // Assuming 900000 is the session limit
        }
        $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first(['id', 'match_name', 'is_active']);

        // Prepare the data to return
        $data = [
            'twoDigits' => $twoDigits,
            'remainingAmounts' => $remainingAmounts,
            'lotteryMatches' => $lottery_matches
        ];

        // Return success response with data
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ], Response::HTTP_OK);
    } catch (\Exception $e) {
        // Log the error or handle it as per your application's error handling policy

        // Return error response
        return response()->json([
            'success' => false,
            'message' => 'Failed to retrieve data. Error: ' . $e->getMessage(),
            'data' => null
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

}