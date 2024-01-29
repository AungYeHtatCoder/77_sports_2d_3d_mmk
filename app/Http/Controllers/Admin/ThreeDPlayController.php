<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use App\Models\ThreedLottery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ThreedMatchTime;
use App\Models\Admin\ThreedLotteryEntry;

class ThreeDPlayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetThreeDigit()
    {
        // get all two digits
        //$twoDigits = TwoDigit::all();
        return view('frontend.threed');
    }

    public function ThreeDigitPlay(){
        return view('frontend.threedigitplay');
    }

    public function ThreeDigitPlayConfirm(){
        
    // $threeDigits = ThreedLotteryEntry::all();

    // $remainingAmounts = [];
    // foreach ($threeDigits as $digit) {
    //     $totalBetAmountForTwoDigit = DB::table('threed_lottery_entries')
    //         ->where('threed_lottery_id', $digit->id)
    //         ->sum('sub_amount');
    // }
    // $lottery_matches = LotteryMatch::where('id', 2)->whereNotNull('is_active')->first();
    $today = Carbon::now();
    // Determine whether to look for the 1st or the 16th of the current month
    $targetDay = $today->day <= 15 ? 1 : 16;

    // Retrieve match time for the target day of the current month
    $matchTime = DB::table('matchings')
        ->whereMonth('match_time', '=', $today->month) // Filter for current month
        ->whereYear('match_time', '=', $today->year) // Filter for current year
        ->whereDay('match_time', '=', $targetDay) // Filter for 1st or 16th day
        ->first(); 

        return view('frontend.threedigitplayconfirm', compact('matchTime'));
    }

    public function ThreeDigitPlayConfirmApi()
{
    $threeDigits = ThreedLotteryEntry::all();
    $maxBetAmountPerDigit = 5000;  // Define the max bet amount per digit

    $remainingAmounts = [];
    foreach ($threeDigits as $digit) {
        $totalBetAmountForDigit = DB::table('threed_lottery_entries')
            ->where('threed_lottery_id', $digit->id)
            ->sum('sub_amount');
        $remainingAmounts[$digit->id] = $maxBetAmountPerDigit - $totalBetAmountForDigit;
    }

    $lottery_matches = LotteryMatch::where('id', 2)->whereNotNull('is_active')->first();

    // Prepare the data you want to return
    $data = [
        'lottery_matches' => $lottery_matches,
        'remainingAmounts' => $remainingAmounts,
        'threeDigits' => $threeDigits,
    ];

    // Return response in JSON format
    return response()->json($data);
}


    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //dd($request->all());
    }
    public function ThreeDigitPlaystore(Request $request)
{
    $validatedData = $request->validate([
        'digit' => 'required|array',
        'sub_amount' => 'required|array',
        'sub_amount.*' => 'required|integer|min:100|max:5000',
        'total_amount' => 'required|numeric|min:100',
        'user_id' => 'required|exists:users,id',
    ]);

    DB::beginTransaction();

    try {
        $user = $this->deductUserBalance($request->total_amount);
        $lottery = $this->createLottery($request->total_amount, $request->user_id);
        $this->attachDigitsToLottery($lottery, $request->digit, $request->input('sub_amount'), $request->input('match_time'));

        DB::commit();
        session()->flash('SuccessRequest', 'Your betting was successful.');
        return back()->with(['success' => 'Digits played successfully.', 'new_balance' => $user->balance]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('error', 'Error: ' . $e->getMessage());
        return back();
    }
}

private function deductUserBalance($totalAmount)
{
    $user = Auth::user();
    $user->balance -= $totalAmount;

    if ($user->balance < 0) {
        throw new \Exception('Not enough balance.');
    }

    $user->save();

    return $user;
}

private function createLottery($totalAmount, $userId)
{
    return ThreedLottery::create([
        'total_amount' => $totalAmount,
        'user_id' => $userId,
        'lottery_match_id' => 2, // This should be dynamically determined or validated
    ]);
}

private function attachDigitsToLottery($lottery, $digits, $subAmounts, $matchTimeId)
{
    foreach ($digits as $key => $digit) {
        $totalBetAmountForDigit = DB::table('threed_lottery_pivot_copy')
            ->where('digit_entry', $digit)
            ->sum('sub_amount');

        if ($totalBetAmountForDigit + $subAmounts[$key] > 5000) {
            throw new \Exception("The bet amount limit for digit {$digit} is exceeded.");
        }

        $matchTime = ThreedMatchTime::find($matchTimeId);
        if (!$matchTime) {
            throw new \Exception('Invalid match time.');
        }

        $lottery->threedMatchTimes()->attach($matchTimeId, [
            'digit_entry' => $digit,
            'sub_amount' => $subAmounts[$key],
            'prize_sent' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
// public function ThreeDigitPlaystore(Request $request)
// {
//     $validatedData = $request->validate([
//         'digit' => 'required|array',
//         'sub_amount' => 'required|array',
//         'sub_amount.*' => 'required|integer|min:100|max:5000',
//         'total_amount' => 'required|numeric|min:100',
//         'user_id' => 'required|exists:users,id',
//     ]);

//     $subAmounts = $request->input('sub_amount');
//     $matchTimeId = $request->input('match_time'); // Assume this is the ID of the match time
    
//     DB::beginTransaction();

//     try {
//         $user = Auth::user();
//         $user->balance -= $request->total_amount;

//         if ($user->balance < 0) {
//             throw new \Exception('Not enough balance.');
//         }

//         $user->save();

//         $lottery = ThreedLottery::create([
//             'total_amount' => $request->total_amount,
//             'user_id' => $request->user_id,
//             'lottery_match_id' => 2, // This should be dynamically determined or validated
//         ]);

//         foreach ($request->digit as $key => $digit) {
//     // Calculate the total bet amount for this digit across all lotteries
//     $totalBetAmountForDigit = DB::table('lottery_match_pivot')
//         ->where('digit_entry', $digit)
//         ->sum('sub_amount');

//     // Check if adding the current sub amount exceeds the limit for this digit
//     if ($totalBetAmountForDigit + $subAmounts[$key] > 5000) {
//         throw new \Exception("The bet amount limit for digit {$digit} is exceeded.");
//     }

//     // Check if the match time is valid
//     $matchTime = ThreedMatchTime::find($matchTimeId);
//     if (!$matchTime) {
//         throw new \Exception('Invalid match time.');
//     }

//     // Attach the digit and sub_amount to the lottery
//     $lottery->threedMatchTimes()->attach($matchTimeId, [
//         'digit_entry' => $digit,
//         'sub_amount' => $subAmounts[$key],
//         'prize_sent' => false,
//         'created_at' => Carbon::now(),
//         'updated_at' => Carbon::now(),
//     ]);
// }


//         // Add notification logic here if needed
//         // ...

//         DB::commit();
//         session()->flash('SuccessRequest', 'Your betting was successful.');
//         return back()->with(['success' => 'Digits played successfully.', 'new_balance' => $user->balance]);
        
//     } catch (\Exception $e) {
//         DB::rollBack();
//         session()->flash('error', 'Error: ' . $e->getMessage());
//         return back();
//     }
// }


// public function ThreeDigitPlaystore(Request $request) {
    
    
//     $validatedData = $request->validate([
//         'digit' => 'required|array',
//         'sub_amount' => 'required|array',
//         'sub_amount.*' => 'required|integer|min:100|max:5000',
//         'total_amount' => 'required|numeric',
//        // 'match_time' => 'required|integer',
       
//     ]);

//     DB::beginTransaction();

//     try {
//         $user = Auth::user();
//         $digits = $request->input('digit');
//         $subAmounts = $request->input('sub_amount');
//         $totalAmount = $request->input('total_amount');
//         $matchTimeId = $request->input('match_time'); // Assume this is the ID of the match time

//         // Check if the user has enough balance
//         if ($user->balance < $totalAmount) {
//             throw new \Exception('Not enough balance.');
//         }

//         // Deduct the total amount from the user's balance
//         $user->balance -= $totalAmount;
//         $user->save();

//         // Create a new lottery entry
//        $lottery = ThreedLottery::create([
//             'total_amount' => $totalAmount,
//             'user_id' => $user->id,
//             'lottery_match_id' => 2, // Replace with actual match ID
//         ]);

//         // Retrieve the match time instance
//         $matchTime = ThreedMatchTime::find($matchTimeId);
//         if (!$matchTime) {
//             throw new \Exception('Invalid match time.');
//         }

//         // Store each digit and sub amount
//         foreach ($digits as $key => $digit) {
//             // Create a new pivot table entry for each digit
//             $lottery->threedMatchTimes()->attach($matchTime, [
//                 'digit_entry' => $digit,
//                 'sub_amount' => $subAmounts[$key],
//                 'prize_sent' => false,
//             ]);
//         }

//         DB::commit();
//         return back()->with(['success' => 'Your betting was successful.', 'new_balance' => $user->balance]);
        
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
//     }
// }
// public function ThreeDigitPlaystore(Request $request) {
        
//     // Validation logic
//     $validatedData = $request->validate([
//         'digit' => 'required|array',
//         'sub_amount' => 'required|array',
//         'sub_amount.*' => 'required|integer|min:100|max:5000',
//         // You might want to validate 'totalBetAmount' as well if it's coming from the request
//         // 'totalBetAmount' => 'required|integer|min:100',
//     ]);

//     //$currentSession = date('H') < 12 ? 'morning' : 'evening';

//     DB::beginTransaction();

//     try {
//         $user = Auth::user();
//         $digits = $request->input('digit');
//         $subAmounts = $request->input('sub_amount');
//         $totalBetAmount = array_sum($subAmounts);

//         if ($user->balance < $totalBetAmount) {
//             throw new \Exception('Not enough balance.');
//         }

//         $user->balance -= $totalBetAmount;
//         $user->save();

//         // Create a new lottery with session logic included
//         $lottery = new ThreedLottery([
//             'total_amount' => $totalBetAmount,
//             'user_id' => $user->id,
//             //'session' => $currentSession,
//             // 'lottery_match_id' should be dynamically determined or validated
//             'lottery_match_id' => 2, // Replace with actual match ID
//         ]);
//         $lottery->save();

//         $threed_lottery_id = $lottery->id;

//         foreach ($digits as $key => $digit) {
//             $totalBetAmountForDigit = ThreedLotteryEntry::where('threed_lottery_id', $threed_lottery_id)
//                                             ->where('digit_entry', $digit)
//                                             ->sum('sub_amount');

//             if ($totalBetAmountForDigit + $subAmounts[$key] > 5000) {
//                 throw new \Exception("The amount limit for the digit {$digit} is full.");
//             }

//             $lottery->entries()->create([
//                 'digit_entry' => $digit,
//                 'sub_amount' => $subAmounts[$key],
//                 'prize_sent' => false,
//             ]);
//         }

//         // You can include notification logic here as per the 'store' method logic
//         // ...

//         DB::commit();
//         session()->flash('SuccessRequest', 'Your betting was successful.');
//         return back()->with(['success' => 'Digits played successfully.', 'new_balance' => $user->balance]);
        
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
//     }
// }

    
//     public function ThreeDigitPlaystore(Request $request) {
//     DB::beginTransaction();

//     try {
//         $user = Auth::user();
//         $digits = $request->input('digit');
//         $subAmounts = $request->input('sub_amount');
//         $totalBetAmount = array_sum($subAmounts);
        
//         // Check if the user has enough balance
//         if ($user->balance < $totalBetAmount) {
//             // Handle case where user does not have enough balance
//             return back()->withErrors(['msg' => 'Not enough balance']);
//         }
        
//         // Deduct the total bet amount from the user's balance
//         $user->balance -= $totalBetAmount;
//         $user->save();

//         // Create a new lottery
//         $lottery = new ThreedLottery([
//             'total_amount' => $totalBetAmount,
//             'user_id' => $user->id,
//             // Ensure 'lottery_match_id' is set correctly.
//             'lottery_match_id' => 2, // Replace with actual match ID
//         ]);
//         $lottery->save();

//         // Assume $lottery->id gives us the new lottery ID
//         $threed_lottery_id = $lottery->id;
//         // foreach loop for checking amount limit 
//         foreach ($request->sub_amount as $key => $value) {
//             $totalBetAmountForDigit = ThreedLotteryEntry::where('threed_lottery_id', $threed_lottery_id)
//                                             ->where('digit_entry', $request->digit[$key])
//                                             ->sum('sub_amount');

//             if ($totalBetAmountForDigit + $request->sub_amounts[$key] > 5000) {
//                 throw new \Exception("The amount limit for the digit {$request->digit[$key]} is full.");
//                 // You may want to redirect back with an error message
//                 session()->flash('AmountLimitFul', 'The amount limit for the digit {$request->digit[$key]} is full.');

//                 return back()->withErrors(['msg' => "The amount limit for the digit {$request->digit[$key]} is full."]);
//             }
//         }

//         // Handle storing the 3-digit plays
//         foreach ($digits as $index => $digit) {
//     $lottery->entries()->create([
//         'digit_entry' => $digit,
//         'sub_amount' => $subAmounts[$index],
//         'prize_sent' => false, // assuming default is false
//     ]);
// }
//         // Commit transaction
//         DB::commit();
//         session()->flash('SuccessRequest', 'သင်၏ကံစမ်းမှု့အောင်မြင်ပါသည် - သိန်းထီဆုကြီးပေါက်ပါစေ');
//         // Return with success message and updated balance
//         return back()->with(['success' => 'Digits played successfully.', 'new_balance' => $user->balance]);
        
//     } catch (\Exception $e) {
//         // An error occurred; cancel the transaction...
//         DB::rollBack();
        
//         // And return with error message
//         return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
//     }
// }

//     public function ThreeDigitPlaystore(Request $request) {
//     // Start transaction
//     DB::beginTransaction();
    
//     try {
//         $user = Auth::user();
//         $digits = $request->input('digit');
//         $subAmounts = $request->input('sub_amount');
//         $totalBetAmount = array_sum($subAmounts);
        
//         // Check if the user has enough balance
//         if ($user->balance < $totalBetAmount) {
//             // Handle case where user does not have enough balance
//             return back()->withErrors(['msg' => 'Not enough balance']);
//         }
        
//         // Deduct the total bet amount from the user's balance
//         $user->balance -= $totalBetAmount;
//         $user->save();

//         // Create a new lottery
//         $lottery = new ThreedLottery([
//             'total_amount' => $totalBetAmount,
//             'user_id' => $user->id,
//             // Assuming 'lottery_match_id' is required; you may need to define this.
//             'lottery_match_id' => 2, // Replace with actual match ID
//         ]);
//         $lottery->save();

//         // Handle storing the 3-digit plays
//         foreach ($digits as $index => $digit) {
            
//             $lottery->entries()->create([
//                 'digit_entry' => $digit,
//                 'sub_amount' => $subAmounts[$index],
//                 'prize_sent' => false, // assuming default is false
//             ]);
//         }

//         // Commit transaction
//         DB::commit();
//         session()->flash('SuccessRequest', 'သိန်းထီဆုကြီးပေါက်ပါစေ.');
//         // Return with success message and updated balance
//         return back()->with(['success' => 'Digits played successfully.', 'new_balance' => $user->balance]);
        
//     } catch (\Exception $e) {
//         // An error occurred; cancel the transaction...
//         DB::rollBack();
        
//         // And return with error message
//         return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
//     }
// }

    /**
     working code
      // foreach ($digits as $index => $digit) {
        //     // Here, retrieve the sum for this specific lottery id and digit
        //     $totalBetAmountForDigit = ThreedLotteryEntry::where('threed_lottery_id', $threed_lottery_id)
        //                                 ->where('digit_entry', $digit)
        //                                 ->sum('sub_amount');

        //     if ($totalBetAmountForDigit + $subAmounts[$index] > 5000) {
        //         throw new \Exception("The amount limit for the digit {$digit} is full.");
        //         // You may want to redirect back with an error message
        //         session()->flash('AmountLimitFul', 'The amount limit for the digit {$digit} is full.');

        //         return back()->withErrors(['msg' => "The amount limit for the digit {$digit} is full."]);
        //     }
        //     $lottery->entries()->create([
        //         'digit_entry' => $digit,
        //         'sub_amount' => $subAmounts[$index],
        //         'prize_sent' => false, // assuming default is false
        //     ]);
        // }

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