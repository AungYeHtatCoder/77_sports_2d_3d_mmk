<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Lottery;
use Illuminate\Http\Request;
//use App\Models\Admin\Lottery;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\LotteryTwoDigitPivot;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TwoDigitPlayed;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TwoDigitPlayedNotification;

class TwoDPlayController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $sessionLimits = [
    'morning' => 5000, // Limit for morning session
    'evening' => 5000  // Limit for evening session
];

    public function GetTwoDigit()
    {
        // get all two digits
        //$twoDigits = TwoDigit::all();
        $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();
        return view('two_d.play_two_d_index', compact('lottery_matches'));
    }

    public function MorningPlayTwoDigit()
    {
        $twoDigits = TwoDigit::all();

    // Calculate remaining amounts for each two-digit
    $remainingAmounts = [];
    foreach ($twoDigits as $digit) {
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');

        $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
    }
    $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

    return view('two_d.twodplay_morning', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));

    }

    public function EveningPlayTwoDigit()
    {
        $twoDigits = TwoDigit::all();

    // Calculate remaining amounts for each two-digit
    $remainingAmounts = [];
    foreach ($twoDigits as $digit) {
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');

        $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
    }
    $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

    return view('two_d.twodplay_evening', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));

    }
    public function QuickMorningPlayTwoDigit()
    {
        $twoDigits = TwoDigit::all();

    // Calculate remaining amounts for each two-digit
    $remainingAmounts = [];
    foreach ($twoDigits as $digit) {
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');

        $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
    }
    $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

    return view('two_d.quick_morning_play', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));

    }
    public function QuickOddMorningPlayTwoDigit()
    {
        $twoDigits = TwoDigit::all();

    // Calculate remaining amounts for each two-digit
    $remainingAmounts = [];
    foreach ($twoDigits as $digit) {
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');

        $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
    }
    $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

    return view('two_d.odd_morning_play', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));

    }

    public function QuickEvenMorningPlayTwoDigit()
    {
        $twoDigits = TwoDigit::all();

    // Calculate remaining amounts for each two-digit
    $remainingAmounts = [];
    foreach ($twoDigits as $digit) {
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');

        $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
    }
    $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

    return view('two_d.even_morning_play', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));

    }

    public function QuickOddSameMorningPlayTwoDigit()
    {
        $twoDigits = TwoDigit::all();

    // Calculate remaining amounts for each two-digit
    $remainingAmounts = [];
    foreach ($twoDigits as $digit) {
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');

        $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
    }
    $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

    return view('two_d.odd_same_morning_play', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));

    }
    public function QuickEvenSameMorningPlayTwoDigit()
    {
        $twoDigits = TwoDigit::all();

    // Calculate remaining amounts for each two-digit
    $remainingAmounts = [];
    foreach ($twoDigits as $digit) {
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');

        $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
    }
    $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

    return view('two_d.even_same_morning_play', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));

    }
    public function index()
    {
        // get all two digits
        $twoDigits = TwoDigit::all();
        return view('admin.two_d.two_digits.new_index', compact('twoDigits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
{
    Log::info($request->all());
    $validatedData = $request->validate([
        'selected_digits' => 'required|string',
        'amounts' => 'required|array',
        'amounts.*' => 'required|integer|min:100|max:5000',
        'totalAmount' => 'required|integer|min:100',
        'user_id' => 'required|exists:users,id',
    ]);

    $currentSession = date('H') < 12 ? 'morning' : 'evening';

    DB::beginTransaction();

    try {
        $user = Auth::user();
        $user->balance -= $request->totalAmount;

        if ($user->balance < 0) {
            throw new \Exception('Your balance is not enough.');
        }

        $user->save();

        $lottery = Lottery::create([
            'pay_amount' => $request->totalAmount,
            'total_amount' => $request->totalAmount,
            'user_id' => $request->user_id,
            'session' => $currentSession
        ]);

        foreach ($request->amounts as $two_digit_string => $sub_amount) {
    // Convert the two-digit string to its numeric ID
    // Assuming '00' corresponds to ID 1, '01' to ID 2, and so on...
    $two_digit_id = $two_digit_string === '00' ? 1 : intval($two_digit_string, 10) + 1;

    // Check if the bet amount for this digit does not exceed the limit
    $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
        ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
        ->where('two_digit_id', $two_digit_id)
        ->where('lotteries.session', $currentSession)
        ->sum('sub_amount');

    if ($totalBetAmountForTwoDigit + $sub_amount > 50000) {
        // Assuming you have a model TwoDigit which corresponds to two_digits table
        $twoDigit = TwoDigit::find($two_digit_id);
        throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
    }

    // Create the pivot entry for the lottery and digit
    $pivot = new LotteryTwoDigitPivot();
    $pivot->lottery_id = $lottery->id;
    $pivot->two_digit_id = $two_digit_id; // Use the numeric ID
    $pivot->sub_amount = $sub_amount;
    $pivot->prize_sent = false;
    $pivot->save();
}

// After the foreach loop, complete any additional logic such as committing the transaction
// and redirecting with a success message or handling exceptions as needed.


        // foreach ($request->amounts as $two_digit_id => $sub_amount) {
        //     $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
        //         ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
        //         ->where('two_digit_id', $two_digit_id)
        //         ->where('lotteries.session', $currentSession)
        //         ->sum('sub_amount');

        //     if ($totalBetAmountForTwoDigit + $sub_amount > 50000) {
        //         $twoDigit = TwoDigit::find($two_digit_id);
        //         throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
        //     }

        //     $pivot = new LotteryTwoDigitPivot();
        //     $pivot->lottery_id = $lottery->id;
        //     $pivot->two_digit_id = $two_digit_id;
        //     $pivot->sub_amount = $sub_amount;
        //     $pivot->prize_sent = false;
        //     $pivot->save();
        // }
        // $admin = User::find(1);
        // $admin->notify(new TwoDigitPlayedNotification($user));
        //Notification::send($admin, new TwoDigitPlayedNotification($user));
        $admins = User::whereHas('roles', function ($query) {
        $query->where('id', 1);
        })->get();
        Notification::send($admins, new TwoDigitPlayedNotification($user));
        DB::commit();
        session()->flash('SuccessRequest', 'သိန်းထီဆုကြီးပေါက်ပါစေ.');

        return redirect()->route('home')->with('message', 'Data stored successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', $e->getMessage());
    }
}

public function Quickstore(Request $request)
{
    //dd($request->all());
    // Validate the request data
    $validatedData = $request->validate([
        'selected_digits' => 'required|string',
        'amounts' => 'required|array',
        'amounts.*' => 'required|numeric|min:100|max:5000',
        'totalAmount' => 'required|numeric|min:100',
        'user_id' => 'required|exists:users,id',
    ]);

    // Determine the current session
    $currentSession = date('H') < 12 ? 'morning' : 'evening';

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Update the user's balance
        $user = Auth::user();
        $user->balance -= $request->totalAmount;
        if ($user->balance < 0) {
            throw new \Exception('Insufficient balance.');
        }
        $user->save();

        // Create a new lottery entry
        $lottery = Lottery::create([
            'pay_amount' => $request->totalAmount,
            'total_amount' => $request->totalAmount,
            'user_id' => $request->user_id,
            'session' => $currentSession,
        ]);
        foreach ($request->amounts as $two_digit_string => $sub_amount) {
    // Convert the two-digit string to its numeric ID
    // Assuming '00' corresponds to ID 1, '01' to ID 2, and so on...
    $two_digit_id = $two_digit_string === '00' ? 1 : intval($two_digit_string, 10) + 1;

    // Check if the bet amount for this digit does not exceed the limit
    $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
        ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
        ->where('two_digit_id', $two_digit_id)
        ->where('lotteries.session', $currentSession)
        ->sum('sub_amount');

    if ($totalBetAmountForTwoDigit + $sub_amount > 50000) {
        // Assuming you have a model TwoDigit which corresponds to two_digits table
        $twoDigit = TwoDigit::find($two_digit_id);
        throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
    }

    // Create the pivot entry for the lottery and digit
    $pivot = new LotteryTwoDigitPivot();
    $pivot->lottery_id = $lottery->id;
    $pivot->two_digit_id = $two_digit_id; // Use the numeric ID
    $pivot->sub_amount = $sub_amount;
    $pivot->prize_sent = false;
    $pivot->save();
}


        // Process each selected digit and its amount
        // foreach ($request->amounts as $two_digit_id => $amount) {
        //     $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
        //         ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
        //         ->where('two_digit_id', $two_digit_id)
        //         ->where('lotteries.session', $currentSession)
        //         ->sum('sub_amount');

        //     if ($totalBetAmountForTwoDigit + $amount > 50000) {
        //         $twoDigit = TwoDigit::find($two_digit_id);
        //         throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
        //     }

        //     $pivot = new LotteryTwoDigitPivot();
        //     $pivot->lottery_id = $lottery->id;
        //     $pivot->two_digit_id = $two_digit_id;
        //     $pivot->sub_amount = $amount;
        //     $pivot->prize_sent = false;
        //     $pivot->save();
        // }

        // Send notifications to admins
        // ... (your existing logic)

        // Commit the transaction
        DB::commit();
        session()->flash('SuccessRequest', 'သိန်းထီဆုကြီးပေါက်ပါစေ.');

        // Redirect back with a success message
        return redirect()->route('home')->with('message', 'Data stored successfully!');
    } catch (\Exception $e) {
        // Rollback the transaction on error
        DB::rollback();
        // Log the error
       // \Log::error($e->getMessage());
        // Redirect back with an error message
        return redirect()->back()->with('error', $e->getMessage());
    }
}


// public function Quickstore(Request $request)
// {
//     //dd($request->all());
//     // Validate the request data
//     $validatedData = $request->validate([
//         'selected_digits' => 'required|string',
//         'amounts' => 'required|array',
//         'amounts.*' => 'required|integer|min:100|max:5000',
//         'totalAmount' => 'required|integer|min:100',
//         'user_id' => 'required|exists:users,id',
//     ]);

//     // Determine the current session based on the time of day
//     $currentSession = date('H') < 12 ? 'morning' : 'evening';

//     // Start a database transaction
//     DB::beginTransaction();

//     try {
//         // Get the authenticated user
//         $user = Auth::user();
//         // Deduct the total amount from the user's balance
//         $user->balance -= $request->totalAmount;

//         // Check if the user has enough balance
//         if ($user->balance < 0) {
//             throw new \Exception('Your balance is not enough.');
//         }

//         // Save the user's new balance
//         $user->save();

//         // Create a new Lottery entry
//         $lottery = Lottery::create([
//             'pay_amount' => $request->totalAmount,
//             'total_amount' => $request->totalAmount,
//             'user_id' => $request->user_id,
//             'session' => $currentSession
//         ]);

//         // Iterate over the amounts for each selected digit
//         foreach ($request->amounts as $two_digit_id => $sub_amount) {
//             // Calculate the total bet amount for the two-digit id in the current session
//             $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
//                 ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
//                 ->where('two_digit_id', $two_digit_id)
//                 ->where('lotteries.session', $currentSession)
//                 ->sum('sub_amount');

//             // Check if the limit for the two-digit amount is exceeded
//             if ($totalBetAmountForTwoDigit + $sub_amount > 5000) {
//                 $twoDigit = TwoDigit::find($two_digit_id);
//                 throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
//             }

//             // Create a new pivot record for Lottery and TwoDigit
//             $pivot = new LotteryTwoDigitPivot();
//             $pivot->lottery_id = $lottery->id;
//             $pivot->two_digit_id = $two_digit_id;
//             $pivot->sub_amount = $sub_amount;
//             $pivot->prize_sent = false;
//             $pivot->save();
//         }

//         // Send notifications to all admins
//         $admins = User::whereHas('roles', function ($query) {
//             $query->where('id', 1);
//         })->get();
//         Notification::send($admins, new TwoDigitPlayedNotification($user));

//         // Commit the transaction
//         DB::commit();

//         // Flash a success message to the session
//         session()->flash('SuccessRequest', 'သိန်းထီဆုကြီးပေါက်ပါစေ.');

//         // Redirect back with a success message
//         return redirect()->back()->with('message', 'Data stored successfully!');
//     } catch (\Exception $e) {
//         // Rollback the transaction in case of an exception
//         DB::rollback();

//         // Redirect back with an error message
//         return redirect()->back()->with('error', $e->getMessage());
//     }
// }


//     public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'selected_digits' => 'required|string',
//         'amounts' => 'required|array',
//         'amounts.*' => 'required|integer|min:100|max:5000',
//         'totalAmount' => 'required|integer|min:100',
//         'user_id' => 'required|exists:users,id',
//     ]);

//     $currentSession = date('H') < 12 ? 'morning' : 'evening';

//     DB::beginTransaction();

//     try {
//         $user = Auth::user();
//         $user->balance -= $request->totalAmount;

//         if ($user->balance < 0) {
//             throw new \Exception('Your balance is not enough.');
//         }

//         $user->save();

//         $lottery = Lottery::create([
//             'pay_amount' => $request->totalAmount,
//             'total_amount' => $request->totalAmount,
//             'user_id' => $request->user_id,
//             'session' => $currentSession
//         ]);

//         foreach ($request->amounts as $two_digit_id => $sub_amount) {
//             $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
//                 ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
//                 ->where('two_digit_id', $two_digit_id)
//                 ->where('lotteries.session', $currentSession)
//                 ->sum('sub_amount');

//             if ($totalBetAmountForTwoDigit + $sub_amount > 5000) {
//                 $twoDigit = TwoDigit::find($two_digit_id);
//                 throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
//             }

//             $pivot = new LotteryTwoDigitPivot();
//             $pivot->lottery_id = $lottery->id;
//             $pivot->two_digit_id = $two_digit_id;
//             $pivot->sub_amount = $sub_amount;
//             $pivot->prize_sent = false;
//             $pivot->save();
//         }

//         DB::commit();

//         return redirect()->back()->with('message', 'Data stored successfully!');
//     } catch (\Exception $e) {
//         DB::rollback();
//         return redirect()->back()->with('error', $e->getMessage());
//     }
// }




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