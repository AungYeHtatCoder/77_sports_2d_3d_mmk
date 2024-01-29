<?php

namespace App\Http\Controllers\User\Threed;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ThreeDigit\Lotto;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ThreeDigit\ThreeDigit;
use App\Models\ThreeDigit\ThreeDigitOverLimit;
use App\Models\ThreeDigit\LotteryThreeDigitPivot;

class ThreeDPlayController extends Controller
{
    public function index()
    {
        return view('frontend.three_d.index');
    }
    // threed play
    public function choiceplay()
    {
        $threeDigits = ThreeDigit::all();

        // Calculate remaining amounts for each two-digit
        $remainingAmounts = [];
        foreach ($threeDigits as $digit) {
            $totalBetAmountForTwoDigit = DB::table('lotto_three_digit_pivot')
                ->where('three_digit_id', $digit->id)
                ->sum('sub_amount');

            $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
        }
        $lottery_matches = LotteryMatch::where('id', 2)->whereNotNull('is_active')->first();

        return view('frontend.three_d.three_d_choice_play', compact('threeDigits', 'remainingAmounts', 'lottery_matches'));
        //return view('three_d.three_d_choice_play');
    }
    public function confirm_play()
    {
        $threeDigits = ThreeDigit::all();

        // Calculate remaining amounts for each two-digit
        $remainingAmounts = [];
        foreach ($threeDigits as $digit) {
            $totalBetAmountForTwoDigit = DB::table('lotto_three_digit_pivot')
                ->where('three_digit_id', $digit->id)
                ->sum('sub_amount');

            $remainingAmounts[$digit->id] = 50000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
        }
        $lottery_matches = LotteryMatch::where('id', 2)->whereNotNull('is_active')->first();

        return view('frontend.three_d.play_confirm', compact('threeDigits', 'remainingAmounts', 'lottery_matches'));
        //return view('three_d.three_d_choice_play');
    }

//     public function user_play()
// {
//     $userId = auth()->id(); // Get the logged-in user's ID

//     $displayThreeDigits = User::getUserThreeDigits($userId);

//     // Log the content of $displayThreeDigits for debugging
//     Log::debug('DisplayThreeDigits content:', $displayThreeDigits);

//     // Use optional helper to safely access properties and avoid errors if the key is missing
//     $threeDigitArray = optional($displayThreeDigits['threeDigit'] ?? null)->toArray() ?? [];
//     $threeDigitOverArray = optional($displayThreeDigits['threeDigitOver'] ?? null)->toArray() ?? [];
    
//     $mergedArray = array_merge($threeDigitArray, $threeDigitOverArray);

//     return view('frontend.three_d.three-d-history', [
//         'displayThreeDigits' => $mergedArray,
//     ]);
// }

// //     public function user_play()
// // {
// //     $userId = auth()->id(); // Get the logged-in user's ID

// //     $displayThreeDigits = User::getUserThreeDigits($userId);
    
// //     // Check if the key 'threeDigit' exists before trying to use it
// //     if (!array_key_exists('threeDigit', $displayThreeDigits)) {
// //         // Handle the error appropriately, maybe log it or return a default value
// //         Log::error("The key 'threeDigit' was not found in the array returned by getUserThreeDigits");
// //         $threeDigitArray = []; // Default value if the key does not exist
// //     } else {
// //         $threeDigitArray = $displayThreeDigits['threeDigit']->toArray();
// //     }

// //     // Check for 'threeDigitOver' key as well
// //     $threeDigitOverArray = array_key_exists('threeDigitOver', $displayThreeDigits) 
// //                            ? $displayThreeDigits['threeDigitOver']->toArray() 
// //                            : [];
    
// //     $mergedArray = array_merge($threeDigitArray, $threeDigitOverArray);

// //     return view('frontend.three_d.three-d-history', [
// //         'displayThreeDigits' => $mergedArray,
// //     ]);
// // }

    // public function user_play()
    // {
    //     $userId = auth()->id(); // Get logged in user's ID

    //     $displayThreeDigits = User::getUserThreeDigits($userId);
    //     $mergedArray = array_merge($displayThreeDigits['threeDigit']->toArray(), $displayThreeDigits['threeDigitOver']->toArray());

    //     return view('frontend.three_d.three-d-history', [
    //         'displayThreeDigits' => $mergedArray,
    //     ]);
    // }
    public function user_play()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayThreeDigits = User::getUserThreeDigits($userId);
        // dd($displayThreeDigits);
        return view('frontend.three_d.three-d-history', [
            'displayThreeDigits' => $displayThreeDigits,
        ]);
    }


    public function store(Request $request)
    {

        //Log::info($request->all());
        $validatedData = $request->validate([
            'selected_digits' => 'required|string',
            'amounts' => 'required|array',
            'amounts.*' => 'required|integer',
            'totalAmount' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        
        $limit = DB::table('three_d_d_limits')->first(); // Define the limit amount
        $limitAmount = $limit->three_d_limit;
        // get first commission From Commission Table
        $commission_percent = DB::table('commissions')->first();
        
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $user->balance -= $request->totalAmount;

            if ($user->balance < 0) {
                throw new \Exception('Insufficient balance.');
            }
            /** @var \App\Models\User $user */
            $user->save();
            // commission calculation
           if($request->totalAmount >= 1000){
            $commission = ($request->totalAmount * $commission_percent->commission) / 100;
            $user->commission_balance += $commission;
            $user->save();
            }

            $lottery = Lotto::create([
                //'pay_amount' => $request->totalAmount,
                'total_amount' => $request->totalAmount,
                'user_id' => $request->user_id,
                //'session' => $currentSession
            ]);

            foreach ($request->amounts as $three_digit_string => $sub_amount) {
                $three_digit_id = $three_digit_string === '00' ? 1 : intval($three_digit_string, 10) + 1;

                $totalBetAmountForTwoDigit = DB::table('lotto_three_digit_copy')
                    ->where('three_digit_id', $three_digit_id)
                    ->sum('sub_amount');

                if ($totalBetAmountForTwoDigit + $sub_amount <= $limitAmount) {
                    $pivot = new LotteryThreeDigitPivot([
                        'lotto_id' => $lottery->id,
                        'three_digit_id' => $three_digit_id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false
                    ]);
                    $pivot->save();
                } else {
                    $withinLimit = $limitAmount - $totalBetAmountForTwoDigit;
                    $overLimit = $sub_amount - $withinLimit;

                    if ($withinLimit > 0) {
                        $pivotWithin = new LotteryThreeDigitPivot([
                            'lotto_id' => $lottery->id,
                            'three_digit_id' => $three_digit_id,
                            'sub_amount' => $withinLimit,
                            'prize_sent' => false
                        ]);
                        $pivotWithin->save();
                    }

                    if ($overLimit > 0) {
                        $pivotOver = new ThreeDigitOverLimit([
                            'lotto_id' => $lottery->id, // corrected from 'lottery_id'
                            'three_digit_id' => $three_digit_id,
                            'sub_amount' => $overLimit,
                            'prize_sent' => false
                        ]);
                        $pivotOver->save();
                    }
                }
            }

            DB::commit();
            session()->flash('SuccessRequest', 'Successfully placed bet.');
            return redirect()->route('user.display')->with('message', 'Data stored successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in store method: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}