<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DailyTwodIncomeOutComeController extends Controller
{
    public function getTotalAmounts() {
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

    // Return the totals as JSON
    return response()->json([
        'dailyTotal'   => $dailyTotal,
        'weeklyTotal'  => $weeklyTotal,
        'monthlyTotal' => $monthlyTotal,
        'yearlyTotal'  => $yearlyTotal,
    ]);
}

// public function getTotalAmountsDaily() {

//     // Group by Day
//     $dailyTotals = Lottery::whereDate('created_at', '=', now()->today())
//                           ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total'))
//                           ->groupBy(DB::raw('DATE(created_at)'))
//                           ->pluck('total', 'date');
    
    
//     // Return the totals as JSON
//     return response()->json([
//         'dailyTotals'   => $dailyTotals,
//     ]);
// } 
public function getTotalAmountsDaily() {

    // Get data for the entire week
    $startOfWeek = now()->startOfWeek();
    $endOfWeek = now()->endOfWeek();
    $dailyTotals = Lottery::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                          ->select(DB::raw('DAYOFWEEK(created_at) as dayOfWeek'), DB::raw('SUM(total_amount) as total'))
                          ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
                          ->pluck('total', 'dayOfWeek')
                          ->toArray();
    
    // Return the totals as JSON
    return response()->json(['dailyTotals' => $dailyTotals]);
}


public function getTotalAmountsWeekly() {

    
    
    // Group by Week
    $weeklyTotals = Lottery::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                           ->select(DB::raw('WEEK(created_at) as week'), DB::raw('SUM(total_amount) as total'))
                           ->groupBy(DB::raw('WEEK(created_at)'))
                           ->pluck('total', 'week');

    
    // Return the totals as JSON
    return response()->json([
        
        'weeklyTotals'  => $weeklyTotals,
        
    ]);
}

// public function getTotalAmountsMonthly() {

    
//     // Group by Month
//     $monthlyTotals = Lottery::whereYear('created_at', '=', now()->year)
//                             ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_amount) as total'))
//                             ->groupBy(DB::raw('MONTH(created_at)'))
//                             ->pluck('total', 'month');

    
//     // Return the totals as JSON
//     return response()->json([
        
//         'monthlyTotals' => $monthlyTotals,
        
//     ]);
// }

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
    $monthlyTotalsQuery = Lottery::whereYear('created_at', '=', now()->year)
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
    $yearlyTotals = Lottery::select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_amount) as total'))
                           ->groupBy(DB::raw('YEAR(created_at)'))
                           ->pluck('total', 'year');

    // Return the totals as JSON
    return response()->json([

        'yearlyTotals'  => $yearlyTotals,
    ]);
}





//     public function getTotalAmounts() 
//     {
//     // Daily Total
//     $dailyTotal = Lottery::whereDate('created_at', '=', now()->today())->sum('total_amount');

//     // Weekly Total
//     $startOfWeek = now()->startOfWeek();
//     $endOfWeek = now()->endOfWeek();
//     $weeklyTotal = Lottery::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');

//     // Monthly Total
//     $monthlyTotal = Lottery::whereMonth('created_at', '=', now()->month)
//                            ->whereYear('created_at', '=', now()->year)
//                            ->sum('total_amount');

//     // Yearly Total
//     $yearlyTotal = Lottery::whereYear('created_at', '=', now()->year)->sum('total_amount');

//     // Return the totals, you can adjust this part as per your needs
//     return view('your_view_name', [
//         'dailyTotal'   => $dailyTotal,
//         'weeklyTotal'  => $weeklyTotal,
//         'monthlyTotal' => $monthlyTotal,
//         'yearlyTotal'  => $yearlyTotal,
//     ]);
// }

}