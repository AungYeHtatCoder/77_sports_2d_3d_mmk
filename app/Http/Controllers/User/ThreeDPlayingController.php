<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Matching;
use App\Models\Admin\BetLottery;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\BetLotteryMatchingCopy;
use App\Models\Admin\ThreedLotteryEntry;

class ThreeDPlayingController extends Controller
{
    public function GetThreeDigit()
    {
        // get all two digits
        //$twoDigits = TwoDigit::all();
        return view('three_d.threed_index');
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
    return BetLottery::create([
        'total_amount' => $totalAmount,
        'user_id' => $userId,
        'lottery_match_id' => 2, // This should be dynamically determined or validated
    ]);
}

private function attachDigitsToLottery($lottery, $digits, $subAmounts, $matchTimeId)
{
    foreach ($digits as $key => $digit) {
        $totalBetAmountForDigit = DB::table('bet_lottery_matching_copy')
            ->where('digit_entry', $digit)
            ->sum('sub_amount');

        if ($totalBetAmountForDigit + $subAmounts[$key] > 5000) {
            throw new \Exception("The bet amount limit for digit {$digit} is exceeded.");
        }

        $matchTime = Matching::find($matchTimeId);
        if (!$matchTime) {
            throw new \Exception('Invalid match time.');
        }

        // $lottery->matchings()->attach($matchTimeId, [
        //     'digit_entry' => $digit,
        //     'sub_amount' => $subAmounts[$key],
        //     'prize_sent' => false,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        $pivot = new BetLotteryMatchingCopy();
        $pivot->matching_id = $matchTimeId;
        $pivot->bet_lottery_id = $lottery->id;
        $pivot->digit_entry = $digit;
        $pivot->sub_amount = $subAmounts[$key];
        $pivot->prize_sent = false;
        $pivot->created_at = Carbon::now();
        $pivot->updated_at = Carbon::now();
        $pivot->save();
        
    }
}
}