<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Admin\TwodWiner;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TwoDMorningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // for 9:30 am
    public function GetDigitEarlMorningindex()
{
    // Retrieve lotteries where the associated LotteryMatch may be active or inactive
    $lotteries = Lottery::whereHas('lotteryMatch')->whereHas('twoDigitsEarlyMorning')->get();

    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                  ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(6), Carbon::now()->startOfDay()->addHours(10)])
                                  ->orderBy('id', 'desc')
                                  ->first();

    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

    // Pass the retrieved data to the view
    return view('admin.two_d.early_morning_play_index', [
        'lotteries' => $lotteries,
        'prize_no' => $prize_no,
        'prize_no_morning' => $prize_no_morning
    ]);
}

    // for 12:1
    public function index()
{
    // Retrieve lotteries where the associated LotteryMatch may be active or inactive
    $lotteries = Lottery::whereHas('lotteryMatch')->whereHas('twoDigitsMorning')->get();

    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                  ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(5), Carbon::now()->startOfDay()->addHours(12)])
                                  ->orderBy('id', 'desc')
                                  ->first();

    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

    // Pass the retrieved data to the view
    return view('admin.two_d.two_d_morning_play_index', [
        'lotteries' => $lotteries,
        'prize_no' => $prize_no,
        'prize_no_morning' => $prize_no_morning
    ]);
}

public function GetDigitEarlyEveningindex()
{
    // Retrieve lotteries where the associated LotteryMatch may be active or inactive
    $lotteries = Lottery::whereHas('lotteryMatch')->whereHas('twoDigitsEarlyEvening')->get();

    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                  ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(16), Carbon::now()->startOfDay()->addHours(18)])
                                  ->orderBy('id', 'desc')
                                  ->first();

    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

    // Pass the retrieved data to the view
    return view('admin.two_d.early_evening_play_index', [
        'lotteries' => $lotteries,
        'prize_no' => $prize_no,
        'prize_no_morning' => $prize_no_morning
    ]);
}


//     public function index()
// {
//     // Retrieve lotteries between 6am and 12pm where the associated LotteryMatch is active
//     $lotteries = Lottery::whereHas('lotteryMatch', function ($query) {
//         $query->where('is_active', true);
//     })->whereHas('twoDigitsMorning')->get();
//     $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
//                                   ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(6), Carbon::now()->startOfDay()->addHours(12)])
//                                  ->orderBy('id', 'desc')
//                                   ->first();
//     $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

//     // Pass the retrieved data to the view
//     return view('admin.two_d.two_d_morning_play_index', [
//         'lotteries' => $lotteries,
//         'prize_no' => $prize_no,
//         'prize_no_morning' => $prize_no_morning
//     ]);
// }

public function EveningTwoD()
{
    // for test purpose only 7 days
    //$playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    // Check if the current day is a playing day

    // $playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    // if (!in_array(strtolower(date('l')), $playDays)) {
    //     // Return an error or a message that today is not a playing day
    //     return redirect()->back()->with('error', 'Today is not a playing day.');
    // }
    // Retrieve lotteries between 6am and 12pm where the associated LotteryMatch is active
    $lotteries = Lottery::whereHas('lotteryMatch', function ($query) {
        $query->where('is_active', true);
    })->whereHas('twoDigitsEvening')->get();
    $prize_no_afternoon = TwodWiner::whereDate('created_at', Carbon::today())
                                  ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(12), Carbon::now()->startOfDay()->addHours(24)])
                                 ->orderBy('id', 'desc')
                                  ->first();
    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    

    // Pass the retrieved data to the view
    return view('admin.two_d.two_d_evening_play_index', [
        'lotteries' => $lotteries,
        'prize_no' => $prize_no,
        'prize_no_afternoon' => $prize_no_afternoon
    ]);
}


public function TwoDMorningWinner()
{
    $lotteries = Lottery::with('twoDigitsMorning')->get();

    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                 ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(5), Carbon::now()->startOfDay()->addHours(13)])
                                 ->orderBy('id', 'desc')
                                 ->first();

    // $prize_no_afternoon = TwodWiner::whereDate('created_at', Carbon::today())
    //                                ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(12), Carbon::now()->startOfDay()->addHours(18)])
    //                                ->orderBy('id', 'desc')
    //                                ->first();
    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    return view('admin.two_d.two_d_morning.morning_win', compact('lotteries', 'prize_no_morning', 'prize_no'));
}

// two d early evening winner 
public function TwoDEarlyEveningWinner()
{
    $lotteries = Lottery::with('twoDigitsEarlyEvening')->get();
    $prize_no_afternoon = TwodWiner::whereDate('created_at', Carbon::today())
                                   ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(12), Carbon::now()->startOfDay()->addHours(18)])
                                   ->orderBy('id', 'desc')
                                   ->first();
    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    return view('admin.two_d.early_evening_winner', compact('lotteries', 'prize_no_afternoon', 'prize_no'));
}

public function TwoDEveningWinner()
{
    $lotteries = Lottery::with('twoDigitsEvening')->get();
    $prize_no_afternoon = TwodWiner::whereDate('created_at', Carbon::today())
                                   ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(12), Carbon::now()->startOfDay()->addHours(18)])
                                   ->orderBy('id', 'desc')
                                   ->first();
    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    return view('admin.two_d.evening.evening_win', compact('lotteries', 'prize_no_afternoon', 'prize_no'));
}

// SendToAccBalanceUpdate 

public function update(Request $request, $lotteryId)
{
    // Validation
    $validated = $request->validate([
        'lottery_id' => 'required|exists:lotteries,id',
        'two_digit_id' => 'required|exists:two_digits,id',
        'amount' => 'required|integer'
    ]);

    $currentTime = Carbon::now();
    $isMorningSession = $currentTime->hour >= 6 && $currentTime->hour < 12; // 6 am to 12 pm
    $isEveningSession = ($currentTime->hour > 12 && $currentTime->hour < 18) || ($currentTime->hour == 12 && $currentTime->minute >= 30); // 12:30 pm to 6 pm

    // If neither morning nor evening session, exit early
    if (!$isMorningSession && !$isEveningSession) {
        return redirect()->back()->with('error', 'Outside of lottery sessions.');
    }

    try {
        // Using DB::transaction to wrap our logic
        DB::transaction(function () use ($request, $lotteryId, $isMorningSession) {
            // Find the lottery entry
            $lottery = Lottery::findOrFail($lotteryId);

            // Determine which relation to use based on the current session
            $relation = $isMorningSession ? $lottery->twoDigitsMorning() : $lottery->twoDigitsEvening();

            // If prize has already been sent, throw an exception
            if ($relation->wherePivot('prize_sent', 1)->count() > 0) {
                throw new \Exception('Prize already sent!');
            }

            // Update the user's balance only if they bet during the current session
            $user = $lottery->user;
            $user->balance += $request->amount;
            $user->save();

            // Mark the prize as sent in the pivot table
            $relation->updateExistingPivot($request->two_digit_id, ['prize_sent' => 1]);
        });

        // If everything goes smoothly and there are no exceptions, then the code outside the transaction will execute
        return redirect()->back()->with('message', 'Amount sent successfully!');

    } catch (\Exception $e) {
        // If there's an exception, we'll catch it here and handle it, like returning with an error message
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

//     public function index()
// {
//     $lotteries = Lottery::with('twoDigits')->get();

//     // Define the two time ranges
//     $morningStart = Carbon::now()->startOfDay()->addHours(6);
//     $morningEnd = Carbon::now()->startOfDay()->addHours(12);

//     $afternoonStart = Carbon::now()->startOfDay()->addHours(12);
//     $afternoonEnd = Carbon::now()->startOfDay()->addHours(18);

//     // Retrieve the records for these ranges
//     $prize_no_morning = TwodWiner::whereBetween('created_at', [$morningStart, $morningEnd])
//                                  ->orderBy('id', 'desc')
//                                  ->first();

//     $prize_no_afternoon = TwodWiner::whereBetween('created_at', [$afternoonStart, $afternoonEnd])
//                                    ->orderBy('id', 'desc')
//                                    ->first();
//  $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
//     return view('admin.two_d.two_d_morning.index', compact('lotteries', 'prize_no_morning', 'prize_no_afternoon', 'prize_no'));
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
//     public function update(Request $request, $lotteryId)
// {
//     // Validation
//     $validated = $request->validate([
//         'lottery_id' => 'required|exists:lotteries,id',
//         'two_digit_id' => 'required|exists:two_digits,id',
//         'amount' => 'required|integer'
//     ]);

//      try {
//         // Using DB::transaction to wrap our logic
//         DB::transaction(function () use ($request, $lotteryId) {
//             // Find the lottery entry
//             $lottery = Lottery::findOrFail($lotteryId);

//             // if prize has already been sent, throw an exception
//             if ($lottery->twoDigitsMorning()->wherePivot('prize_sent', 1)->count() > 0) {
//                 throw new \Exception('Prize already sent!');
//             }

//             // Update the user's balance
//             $user = $lottery->user;
//             $user->balance += $request->amount;  // Adding the prize amount to the user's balance.
//             $user->save();

//             // Mark the prize as sent in the pivot table
//             $lottery->twoDigitsMorning()->updateExistingPivot($request->two_digit_id, ['prize_sent' => 1]);
//         });

//         // If everything goes smoothly and there are no exceptions, then the code outside the transaction will execute
//         return redirect()->back()->with('message', 'Amount sent successfully!');

//     } catch (\Exception $e) {
//         // If there's an exception, we'll catch it here and handle it, like returning with an error message
//         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
//     }

    
// }
//    public function update(Request $request, $userId)
// {
//     // Validation
//     $validated = $request->validate([
//         'user_id' => 'required|exists:users,id',
//         'amount' => 'required|integer'
//     ]);

//     try {
//         // Using DB::transaction to wrap our logic
//         DB::transaction(function () use ($request, $userId) {
//             // Find the user
//             $user = User::findOrFail($userId);  // Using 'findOrFail' to throw an exception if the user doesn't exist.

//             // Update the user's balance
//             $user->balance += $request->amount;  // Adding the prize amount to the user's balance.

//             // Save the changes
//             $user->save();
//         });

//         // If everything goes smoothly and there are no exceptions, then the code outside the transaction will execute
//         return redirect()->back()->with('message', 'Amount sent successfully!');

//     } catch (\Exception $e) {
//         // If there's an exception, we'll catch it here and handle it, like returning with an error message
//         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
//     }
// }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}