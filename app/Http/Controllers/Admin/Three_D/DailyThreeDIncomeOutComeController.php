<?php

namespace App\Http\Controllers\Admin\ThreeD;

use Illuminate\Http\Request;
use App\Models\ThreeDigit\Lotto;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DailyThreeDIncomeOutComeController extends Controller
{
     public function getTotalAmounts() {
// Daily Total
    $dailyTotal = Lotto::whereDate('created_at', '=', now()->today())->sum('total_amount');

    // Weekly Total
    $startOfWeek = now()->startOfWeek();
    $endOfWeek = now()->endOfWeek();
    $weeklyTotal = Lotto::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');

    // Monthly Total
    $monthlyTotal = Lotto::whereMonth('created_at', '=', now()->month)
                           ->whereYear('created_at', '=', now()->year)
                           ->sum('total_amount');

    // Yearly Total
    $yearlyTotal = Lotto::whereYear('created_at', '=', now()->year)->sum('total_amount');

    // Return the totals as JSON
    return response()->json([
        'dailyTotal'   => $dailyTotal,
        'weeklyTotal'  => $weeklyTotal,
        'monthlyTotal' => $monthlyTotal,
        'yearlyTotal'  => $yearlyTotal,
    ]);
}

    public function getTotalAmountsDaily() {

    // Get data for the entire week
    $startOfWeek = now()->startOfWeek();
    $endOfWeek = now()->endOfWeek();
    $dailyTotals = Lotto::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                          ->select(DB::raw('DAYOFWEEK(created_at) as dayOfWeek'), DB::raw('SUM(total_amount) as total'))
                          ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
                          ->pluck('total', 'dayOfWeek')
                          ->toArray();
    
    // Return the totals as JSON
    return response()->json(['dailyTotals' => $dailyTotals]);
}


    public function getTotalAmountsWeekly() 
    {

    // Group by Week
    $weeklyTotals = Lotto::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                           ->select(DB::raw('WEEK(created_at) as week'), DB::raw('SUM(total_amount) as total'))
                           ->groupBy(DB::raw('WEEK(created_at)'))
                           ->pluck('total', 'week');

    
    // Return the totals as JSON
    return response()->json([
        
        'weeklyTotals'  => $weeklyTotals,
        
    ]);
}

public function getTotalAmountsMonthly() {
    // Define month names
    $monthNames = [
        '1' => 'Jan',
        '2' => 'Feb',
        '3' => 'Mar',
        '4' => 'Apr',
        '5' => 'May',
        '6' => 'Jun',
        '7' => 'Jul',
        '8' => 'Aug',
        '9' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dec'
    ];
    
    // Group by Month
    $monthlyTotalsQuery = Lotto::whereYear('created_at', '=', now()->year)
                                 ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_amount) as total'))
                                 ->groupBy(DB::raw('MONTH(created_at)'))
                                 ->get();

    // Convert month numbers to names
    $monthlyTotals = [];
    foreach ($monthlyTotalsQuery as $row) {
        $monthlyTotals[$monthNames[$row->month]] = $row->total;
    }

    // Return the totals as JSON
    return response()->json([
        'monthlyTotals' => $monthlyTotals,
    ]);
}


public function getTotalAmountsYearly() {
    // Group by Year
    $yearlyTotals = Lotto::select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_amount) as total'))
                           ->groupBy(DB::raw('YEAR(created_at)'))
                           ->pluck('total', 'year');

    // Return the totals as JSON
    return response()->json([

        'yearlyTotals'  => $yearlyTotals,
    ]);
}

}