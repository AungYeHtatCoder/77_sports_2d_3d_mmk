<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LotteryTwoDigitPivot;
use Illuminate\Support\Facades\Auth;

class TwoDigitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function __construct()
// {
//     $this->middleware('lottery.available')->only(['store']);
//     // or
//     // $this->middleware('lottery.available')->except(['index']);
// }

    public function index()
    {
        // get all two digits
        $twoDigits = TwoDigit::all();
        $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();
        return view('admin.two_d.two_digits.new_index', compact('twoDigits', 'lottery_matches'));
    }

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

// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'selected_digits' => 'required|string',
//         'amounts' => 'required|array',
//         'amounts.*' => 'required|integer|min:100|max:5000',
//         'totalAmount' => 'required|integer|min:100',
//         'user_id' => 'required|exists:users,id',
//     ]);

//     // Working days check
//     $workingDays = [1, 2, 3, 4, 5];
//     $day = Carbon::now()->dayOfWeek;
//     if (!in_array($day, $workingDays)) {
//         return redirect()->back()->with('error', 'Today is not a working day.');
//     }

//     // Determine the session
//     $currentSession = date('H') < 12 ? 'morning' : 'evening';  // before 1 pm is morning

//     // Check for specific times when the store is not available
//     $morningCloseStart = Carbon::createFromTime(11, 30, 0);
//     $morningCloseEnd = Carbon::createFromTime(12, 0, 0);
//     $eveningCloseStart = Carbon::createFromTime(15, 45, 0);
//     $eveningCloseEnd = Carbon::createFromTime(16, 0, 0);
//     $now = Carbon::now();
//     if (($now->between($morningCloseStart, $morningCloseEnd)) || ($now->between($eveningCloseStart, $eveningCloseEnd))) {
//         return redirect()->back()->with('error', 'This session is closed. Please try again later.');
//     }

//     DB::beginTransaction();

//     try {
//         // Deduct the total amount from the user's balance
//         $user = Auth::user();
//         $user->balance -= $request->totalAmount;

//         // Check if user balance is negative after deduction
//         if ($user->balance < 0) {
//             throw new \Exception('Your balance is not enough.');
//         }

//         // Update user balance in the database
//         $user->save();

//         $lottery = Lottery::create([
//             'pay_amount' => $request->totalAmount,
//             'total_amount' => $request->totalAmount,
//             'user_id' => $request->user_id,
//             'session' => $currentSession
//         ]);

//         $attachData = [];
//         foreach($request->amounts as $two_digit_id => $sub_amount) {
//             $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
//                     ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
//                     ->where('two_digit_id', $two_digit_id)
//                     ->where('lotteries.session', $currentSession)
//                     ->sum('sub_amount');

//             if($totalBetAmountForTwoDigit + $sub_amount > 5000) {
//                 $twoDigit = TwoDigit::find($two_digit_id);
//                 throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
//             }
//             $attachData[$two_digit_id] = ['sub_amount' => $sub_amount];
//         }

//         $lottery->twoDigits()->attach($attachData);

//         DB::commit();

//         return redirect()->back()->with('message', 'Data stored successfully!');
//     } catch (\Exception $e) {
//         DB::rollback();
//         return redirect()->back()->with('error', $e->getMessage());
//     }
// }

// new copies 
public function store(Request $request)
{
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

        foreach ($request->amounts as $two_digit_id => $sub_amount) {
            $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
                ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
                ->where('two_digit_id', $two_digit_id)
                ->where('lotteries.session', $currentSession)
                ->sum('sub_amount');

            if ($totalBetAmountForTwoDigit + $sub_amount > 5000) {
                $twoDigit = TwoDigit::find($two_digit_id);
                throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
            }

            $pivot = new LotteryTwoDigitPivot();
            $pivot->lottery_id = $lottery->id;
            $pivot->two_digit_id = $two_digit_id;
            $pivot->sub_amount = $sub_amount;
            $pivot->prize_sent = false;
            $pivot->save();
        }

        DB::commit();

        return redirect()->back()->with('message', 'Data stored successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', $e->getMessage());
    }
}


//     public function store(Request $request)
// {
//     //dd($request->all());
//     $validatedData = $request->validate([
//         'selected_digits' => 'required|string',
//         'amounts' => 'required|array',
//         'amounts.*' => 'required|integer|min:100|max:5000',
//         'totalAmount' => 'required|integer|min:100',
//         'user_id' => 'required|exists:users,id',
//     ]);

//     $currentSession = date('H') < 12 ? 'morning' : 'evening';  // before 1 pm is morning

//     DB::beginTransaction();

//     try {
//         // Deduct the total amount from the user's balance
//         $user = Auth::user();
//         $user->balance -= $request->totalAmount;

//         // Check if user balance is negative after deduction
//         if ($user->balance < 0) {
//             throw new \Exception('Your balance is not enough.');
//         }

//         // Update user balance in the database
//         $user->save();

//         $lottery = Lottery::create([
//             'pay_amount' => $request->totalAmount,
//             'total_amount' => $request->totalAmount,
//             'user_id' => $request->user_id,
//             'session' => $currentSession
//         ]);

//         $attachData = [];
//         foreach($request->amounts as $two_digit_id => $sub_amount) {
//             $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
//                     ->join('lotteries', 'lotteries.id', '=', 'lottery_two_digit_pivot.lottery_id')
//                     ->where('two_digit_id', $two_digit_id)
//                     ->where('lotteries.session', $currentSession)
//                     ->sum('sub_amount');

//             if($totalBetAmountForTwoDigit + $sub_amount > 5000) {
//                 $twoDigit = TwoDigit::find($two_digit_id);
//                 throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
//             }
//             $attachData[$two_digit_id] = ['sub_amount' => $sub_amount];
//         }

//         $lottery->twoDigits()->attach($attachData);

//         DB::commit();

//         return redirect()->back()->with('message', 'Data stored successfully!');
//     } catch (\Exception $e) {
//         DB::rollback();
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

//     DB::beginTransaction();

//     try {
//         // Deduct the total amount from the user's balance
//         $user = Auth::user();
//         $user->balance -= $request->totalAmount;

//         // Check if user balance is negative after deduction
//         if ($user->balance < 0) {
//             throw new \Exception('Your balance is not enough.');
//         }

//         // Update user balance in the database
//         $user->save();

//         $lottery = Lottery::create([
//             'pay_amount' => $request->totalAmount,
//             'total_amount' => $request->totalAmount,
//             'user_id' => $request->user_id,
//         ]);

//         $attachData = [];
//         foreach($request->amounts as $two_digit_id => $sub_amount) {
//             $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
//                     ->where('two_digit_id', $two_digit_id)
//                     ->sum('sub_amount');

//             if($totalBetAmountForTwoDigit + $sub_amount > 5000) {
//                 $twoDigit = TwoDigit::find($two_digit_id);
//                 throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
//             }
//             $attachData[$two_digit_id] = ['sub_amount' => $sub_amount];
//         }

//         $lottery->twoDigits()->attach($attachData);

//         DB::commit();

//         return redirect()->back()->with('message', 'Data stored successfully!');
//     } catch (\Exception $e) {
//         DB::rollback();
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

//     DB::beginTransaction();

//     try {
//         // Deduct the total amount from the user's balance
//         $user = Auth::user();
//         $user->balance -= $request->totalAmount;

//         // Check if user balance is negative after deduction
//         if ($user->balance < 0) {
//             return redirect()->back()->with('error', 'Your balance is not enough.');
//         }

//         // Update user balance in the database
//         $user->save();

//         $lottery = Lottery::create([
//             'pay_amount' => $request->totalAmount,
//             'total_amount' => $request->totalAmount,
//             'user_id' => $request->user_id,
//         ]);

//         $attachData = [];
//         foreach($request->amounts as $two_digit_id => $sub_amount) {
//             $attachData[$two_digit_id] = ['sub_amount' => $sub_amount];
//         }

//         $lottery->twoDigits()->attach($attachData);

//         DB::commit();

//         return redirect()->back()->with('message', 'Data stored successfully!');
//     } catch (\Exception $e) {
//         DB::rollback();
        
//         // Optional: Log the exception for debugging
//         //\Log::error($e);

//         return redirect()->back()->with('error', 'Something went wrong. Please try again.');
//     }
// }

// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'selected_digits' => 'required|string',
//         'amounts' => 'required|array',
//         'amounts.*' => 'required|integer|min:100|max:5000',
//         'totalAmount' => 'required|integer|min:100',
//         'user_id' => 'required|exists:users,id',
//     ]);

//     DB::beginTransaction();

//     try {
//         $lottery = Lottery::create([
//             'pay_amount' => $request->totalAmount,
//             'total_amount' => $request->totalAmount,
//             'user_id' => $request->user_id,
//         ]);

//         $attachData = [];
//         foreach($request->amounts as $two_digit_id => $sub_amount) {
//             $attachData[$two_digit_id] = ['sub_amount' => $sub_amount];
//         }

//         $lottery->twoDigits()->attach($attachData);

//         DB::commit();

//         return redirect()->back()->with('message', 'Data stored successfully!');
//     } catch (\Exception $e) {
//         DB::rollback();
        
//         // Optional: Log the exception for debugging
//         //\Log::error($e);

//         return redirect()->back()->with('error', 'Something went wrong. Please try again.');
//     }
// }

//     public function store(Request $request)
// {
//     // Validate your request data if needed...
//      $validatedData = $request->validate([
//         'selected_digits' => 'required|string',
//         'amounts' => 'required|array',
//         'amounts.*' => 'required|integer|min:100|max:5000',
//         'totalAmount' => 'required|integer|min:100',
//         'user_id' => 'required|exists:users,id', // Ensure user ID exists in the users table
//     ]);
//     // Create a new lottery
//     $lottery = Lottery::create([
//         'pay_amount' => $request->totalAmount,  // Or any other logic for pay_amount if it's different
//         'total_amount' => $request->totalAmount,
//         'user_id' => $request->user_id,
//         // Any other necessary attributes...
//     ]);

//     // Prepare the data to be attached
//     $attachData = [];
//     foreach($request->amounts as $two_digit_id => $sub_amount) {
//         $attachData[$two_digit_id] = ['sub_amount' => $sub_amount];
//     }

//     // Attach the two digits to the lottery
//     $lottery->twoDigits()->attach($attachData);

//     // Maybe redirect with a success message or something...
//     return redirect()->back()->with('message', 'Data stored successfully!');
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