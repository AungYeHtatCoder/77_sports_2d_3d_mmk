<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class PlayTwoDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // get all two digits
    $twoDigits = TwoDigit::all();

    // Calculate remaining amounts for each two-digit
    $remainingAmounts = [];
    foreach ($twoDigits as $digit) {
        $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');

        $remainingAmounts[$digit->id] = 5000 - $totalBetAmountForTwoDigit; // Assuming 5000 is the session limit
    }
    $lottery_matches = LotteryMatch::where('id', 1)->whereNotNull('is_active')->first();

    return view('play_twod', compact('twoDigits', 'remainingAmounts', 'lottery_matches'));
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
    $validatedData = $request->validate([
        'selected_digits' => 'required|string',
        'amounts' => 'required|array',
        'amounts.*' => 'required|integer|min:100|max:5000',
        'totalAmount' => 'required|integer|min:100',
        'user_id' => 'required|exists:users,id',
    ]);

    DB::beginTransaction();

    try {
        // Deduct the total amount from the user's balance
        $user = Auth::user();
        $user->balance -= $request->totalAmount;

        // Check if user balance is negative after deduction
        if ($user->balance < 0) {
            throw new \Exception('Your balance is not enough.');
        }

        // Update user balance in the database
        $user->save();

        $lottery = Lottery::create([
            'pay_amount' => $request->totalAmount,
            'total_amount' => $request->totalAmount,
            'user_id' => $request->user_id,
        ]);

        $attachData = [];
        foreach($request->amounts as $two_digit_id => $sub_amount) {
            $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_pivot')
                    ->where('two_digit_id', $two_digit_id)
                    ->sum('sub_amount');

            if($totalBetAmountForTwoDigit + $sub_amount > 5000) {
                $twoDigit = TwoDigit::find($two_digit_id);
                throw new \Exception("The two-digit's amount limit for {$twoDigit->two_digit} is full.");
            }
            $attachData[$two_digit_id] = ['sub_amount' => $sub_amount];
        }

        $lottery->twoDigits()->attach($attachData);

        DB::commit();

        return redirect()->back()->with('message', 'Data stored successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', $e->getMessage());
    }
    // return response()->json([
    //         'success' => true,
    //         'message' => 'Data stored successfully!'
    //     ]);
    // } catch (\Exception $e) {
    //     DB::rollback();
    //     return response()->json([
    //         'success' => false,
    //         'error' => $e->getMessage()
    //     ]);
    // }
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