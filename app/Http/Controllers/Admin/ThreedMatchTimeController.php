<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ThreedMatchTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $today = Carbon::now();
    // Determine whether to look for the 1st or the 16th of the current month
    $targetDay = $today->day <= 15 ? 1 : 16;

    // Retrieve match time for the target day of the current month
    $matchTime = DB::table('threed_match_times')
        ->whereMonth('match_time', '=', $today->month) // Filter for current month
        ->whereYear('match_time', '=', $today->year) // Filter for current year
        ->whereDay('match_time', '=', $targetDay) // Filter for 1st or 16th day
        ->first(); // Use first() to get a single record

    // Pass the match time to the view
    return view('admin.three_d.t_d_match.index', compact('matchTime'));
}

//     public function index()
// {
//     // Use Carbon to get the current year and the name of the current month
//     $currentYear = Carbon::now()->year;
//     $currentMonth = Carbon::now()->month; // Retrieve numeric month

//     // Retrieve match times for the 1st and 16th of the current month
//     $matchTimes = DB::table('threed_match_times')
//         ->whereMonth('match_time', '=', $currentMonth) // Filter for current month
//         ->whereYear('match_time', '=', $currentYear) // Filter for current year
//         ->whereIn('match_time', [
//             Carbon::createFromDate($currentYear, $currentMonth, 1)->toDateString(), // 1st of the month
//             Carbon::createFromDate($currentYear, $currentMonth, 16)->toDateString()  // 16th of the month
//         ])
//         ->get();

//     // Pass the match times to the view
//     return view('admin.three_d.t_d_match.index', compact('matchTimes'));
// }

//     public function index()
// {
//     // Use Carbon to get the current year, month, and day
//     $currentYear = Carbon::now()->year;
//     $currentMonthName = Carbon::now()->format('F');
//     $currentDay = Carbon::now()->day;

//     // Determine the index for open_time based on the day of the month
//     $openTimeIndex = $currentDay <= 15 ? 1 : 2; // Assuming "1: Time" for 1st, "2: Time" for 16th

//     // Prepare the search string for the current match time
//     $searchString = "{$currentDay} - {$currentMonthName} - {$currentYear}";

//     // Retrieve the match time for the current period of the month (1st or 16th)
//     $matchTime = DB::table('threed_match_times')
//         ->where('match_time', 'LIKE', "%{$searchString}%")
//         ->first();

//     // Find the corresponding open_time from the database or some other source
//     $openTime = $openTimeIndex === 1 ? "1: Time" : "16: Time"; // Replace with actual logic to get open_time

//     // Pass the match time and open time to the view
//     return view('admin.three_d.t_d_match.index', compact('matchTime', 'openTime'));
// }

//     public function index()
// {
//     // Use Carbon to get the current year and the name of the current month
//     $currentYear = Carbon::now()->year;
//     $currentMonthName = Carbon::now()->format('F');

//     // Prepare the search strings for the 1st and 16th of the current month
//     $searchStringFirst = "1 - {$currentMonthName} - {$currentYear}";
//     $searchStringSixteenth = "16 - {$currentMonthName} - {$currentYear}";

//     // Retrieve match times for the 1st and 16th of the current month
//     $matchTimes = DB::table('threed_match_times')
//         ->where(function ($query) use ($searchStringFirst, $searchStringSixteenth) {
//             $query->where('match_time', 'LIKE', "%{$searchStringFirst}%")
//                   ->orWhere('match_time', 'LIKE', "%{$searchStringSixteenth}%");
//         })
//         ->get();

//     // Pass the match times to the view
//     return view('admin.three_d.t_d_match.index', compact('matchTimes'));
// }

//     public function index()
// {
//     // Use Carbon to get the current year and the name of the current month
//     $currentYear = Carbon::now()->year;
//     $currentMonthName = Carbon::now()->format('F');

//     // Prepare the search strings for the 1st and 16th of the current month
//     $searchStringFirst = "1 - {$currentMonthName} - {$currentYear}";
//     $searchStringSixteenth = "16 - {$currentMonthName} - {$currentYear}";

//     // Retrieve match times for the 1st and 16th of the current month
//     $matchTimes = DB::table('threed_match_times')
//         ->where('match_time', 'LIKE', "%{$searchStringFirst}%")
//         ->orWhere('match_time', 'LIKE', "%{$searchStringSixteenth}%")
//         ->get();

//     // Pass the match times to the view
//     return view('admin.three_d.t_d_match.index', compact('matchTimes'));
// }

    // public function index()
    // {
    //     // Define months and their days
    //     $months = [
    //         'January' => 31,
    //         'February' => 28, // You need to handle leap years separately
    //         'March' => 31,
    //         'April' => 30,
    //         'May' => 31,
    //         'June' => 30,
    //         'July' => 31,
    //         'August' => 31,
    //         'September' => 30,
    //         'October' => 31,
    //         'November' => 30,
    //         'December' => 31,
    //     ];

    //     // Check for leap year and adjust February if needed
    //     $year = date('Y'); // Current year
    //     if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
    //         $months['February'] = 29;
    //     } 
    //     // Use Carbon to handle dates
    //     $today = Carbon::today();
    //     $currentMonth = $today->format('F'); // Current month as string e.g., 'January'
    //     $currentYear = $today->year;

    //     // Check if today's date is before or on the 16th
    //     $matchTime = $today->day <= 15 ? "1 - {$currentMonth} - {$currentYear}" : "16 - {$currentMonth} - {$currentYear}";

    //     // Check if the match time for the current period exists in the database
    //     $existingMatchTime = DB::table('threed_match_times')
    //         ->where('match_time', 'LIKE', "%{$matchTime}%")
    //         ->first();
    //     return view('admin.three_d.t_d_match.index', compact('existingMatchTime'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}