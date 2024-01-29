<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Currency;
use App\Models\Admin\LotteryMatch;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\TwoDLimit;
use App\Models\Lottery;
use App\Models\LotteryTwoDigitCopy;
use App\Models\LotteryTwoDigitPivot;
use App\Models\Two\LotteryTwoDigitOverLimit;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TwoDController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $digits = TwoDigit::all();
        $break = TwoDLimit::latest()->first()->two_d_limit;
        foreach($digits as $digit)
        {
            $totalAmount = LotteryTwoDigitCopy::where('two_digit_id', $digit->id)->sum('sub_amount');
            $remaining = $break-$totalAmount;
            $digit->remaining = $remaining;
        }
        return $this->success([
            'break' => $break,
            'two_digits' => $digits,
        ]);
    }

    public function play(Request $request)
    {
        // Log the entire request
        Log::info($request->all());
        $break = TwoDLimit::latest()->first()->two_d_limit;
        // Convert JSON request to an array
        $data = $request->json()->all();
    
        // Validate the incoming data
        $validator = Validator::make($data, [
            'currency' => 'required|string',
            'totalAmount' => 'required|numeric|min:1',
            'amounts' => 'required|array',
            'amounts.*.num' => 'required|integer',
            'amounts.*.amount' => 'required|integer|min:1',
            // 'amounts.*.amount' => 'required|integer|min:1|max:'.$break,
        ]);
    
        // Check for validation errors
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
    
        // Extract validated data
        $validatedData = $validator->validated();

        // Currency auto exchange
        if ($request->currency == "baht") {
            $rate = Currency::latest()->value('rate');
            $subAmount = array_sum(array_column($request->amounts, 'amount')) * $rate;
        }else{
            $subAmount = array_sum(array_column($request->amounts, 'amount'));
        }
        
        if ($subAmount > $break) {
            return response()->json(['message' => 'Limit ပမာဏထက်ကျော်ထိုးလို့ မရပါ။'], 401);
        }

        // Determine the current session based on time
        $currentSession = date('H') < 12 ? 'morning' : 'evening';
        // if ($validatedData['totalAmount'] > $break) {
        //     return response()->json(['message' => 'Total Amount is over limit'], 401);
        // }
    
        // Start database transaction
        DB::beginTransaction();
    
        try {
            $rate = Currency::latest()->first()->rate;
            if($request->currency == 'baht'){
                $totalAmount = $request->totalAmount * $rate;
            }else{
                $totalAmount = $request->totalAmount;
            }
            
            $user = Auth::user();
            $user->balance -= $totalAmount;
    
            // Check if the user has sufficient balance
            if ($user->balance < 0) {
                return response()->json(['message' => 'လက်ကျန်ငွေ မလုံလောက်ပါ။'], 401);
            }
            /** @var \App\Models\User $user */
            $user->save();
    
            // Create a new lottery entry
            $lottery = Lottery::create([
                'pay_amount' => $totalAmount,
                'total_amount' => $totalAmount,
                'user_id' => $user->id, // Use authenticated user's ID
                'session' => $currentSession
            ]);
    
            // Iterate through each bet and process it
            foreach ($validatedData['amounts'] as $bet) {
                $two_digit_id = $bet['num'] === 0 ? 100 : $bet['num']; // Assuming '00' corresponds to 100

                $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                ->where('two_digit_id', $two_digit_id)
                ->sum('sub_amount');
    
                // ... Your betting logic here ...
                if($request->currency == 'baht'){
                    $sub_amount = $bet['amount'] * $rate;
                }else{
                    $sub_amount = $bet['amount'];
                }

                if ($totalBetAmountForTwoDigit + $sub_amount <= $break) {
                    $pivot = new LotteryTwoDigitPivot([
                        'lottery_id' => $lottery->id,
                        'two_digit_id' => $two_digit_id,
                        'sub_amount' => $sub_amount,
                        'prize_sent' => false
                    ]);
                    $pivot->save();
                } else {
                    $withinLimit = $break - $totalBetAmountForTwoDigit;
                    $overLimit = $sub_amount - $withinLimit;

                    if ($withinLimit > 0) {
                        $pivotWithin = new LotteryTwoDigitPivot([
                            'lottery_id' => $lottery->id,
                            'two_digit_id' => $two_digit_id,
                            'sub_amount' => $withinLimit,
                            'prize_sent' => false
                        ]);
                        $pivotWithin->save();
                    }

                    if ($overLimit > 0) {
                        $pivotOver = new LotteryTwoDigitOverLimit([
                            'lottery_id' => $lottery->id,
                            'two_digit_id' => $two_digit_id,
                            'sub_amount' => $overLimit,
                            'prize_sent' => false
                        ]);
                        $pivotOver->save();
                    }
                }
            }
    
            // Commit the transaction
            DB::commit();
    
            // Return a success response
            return $this->success([
                'message' => 'Bet placed successfully',
            ]);
            // return response()->json(['message' => 'Bet placed successfully'], 200);
        } catch (\Exception $e) {
            // Roll back the transaction in case of error
            DB::rollback();
            Log::error('Error in play method: ' . $e->getMessage());
    
            // Return an error response
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function playHistory()
    {
        $userId = auth()->id();
        $history9am = User::getUserEarlyMorningTwoDigits($userId);
        $history12pm = User::getUserMorningTwoDigits($userId);
        $history2pm = User::getUserEarlyEveningTwoDigits($userId);
        $history4pm = User::getUserEveningTwoDigits($userId);

        return $this->success([
            'history9am' => $history9am,
            'history12pm' => $history12pm,
            'history2pm' => $history2pm,
            'history4pm' => $history4pm,
        ]);
    }
    public function TwoDigitOnceMonthHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $twod_once_month_history = User::getUserOneMonthTwoDigits($userId);
        return $this->success([
            $twod_once_month_history
        ]);
    }
}