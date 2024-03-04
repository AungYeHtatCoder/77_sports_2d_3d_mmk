<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Admin\Currency;
use App\Services\LottoService;
use App\Models\Admin\Commission;
use App\Models\ThreeDigit\Lotto;
use App\Models\Admin\ThreedDigit;
use Illuminate\Http\JsonResponse;
use App\Models\Admin\LotteryMatch;
use App\Models\Admin\ThreeDDLimit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ThreeDigit\ThreeDigit;
use App\Models\ThreeDigit\ThreedClose;
use App\Http\Requests\PlayLottoRequest;
use App\Http\Requests\ThreedPlayRequest;
use App\Models\ThreeDigit\ThreeDigitOverLimit;
use App\Models\ThreeDigit\LotteryThreeDigitCopy;
use App\Models\ThreeDigit\LotteryThreeDigitPivot;

class ThreeDController extends Controller
{
    use HttpResponses;
    protected $lottoService;

    public function __construct(LottoService $lottoService)
    {
        $this->lottoService = $lottoService;
    }
    public function index()
    {
        $digits = ThreeDigit::all();
        $break = ThreeDDLimit::latest()->first()->three_d_limit;
        foreach($digits as $digit){
            $totalAmount = DB::table('lotto_three_digit_copy')->where('three_digit_id', $digit->id)->sum('sub_amount');
            $break = ThreeDDLimit::latest()->first()->three_d_limit;
            $remaining = $break-$totalAmount;
            $digit->remaining = $remaining;
        }
        $lottery_matches = LotteryMatch::where('id', 2)->whereNotNull('is_active')->first(['id', 'match_name', 'is_active']);
        return $this->success([
            'digits' => $digits,
            'break' => $break,
            'lottery_matches' => $lottery_matches
        ]);
    }

     public function play(ThreedPlayRequest $request): JsonResponse
    {
        //Log::info($request->all());
        $totalAmount = $request->input('totalAmount');
        $amounts = $request->input('amounts');

        // if($totalAmount > Auth::user()->balance){
        //     return response()->json(['success' => false, 'message' => 'လက်ကျန်ငွေ မလုံလောက်ပါ။'], 401);
        // }

        $closedTwoDigits = ThreedClose::query()
            ->pluck('digit')
            ->map(function ($digit) {
                // Ensure formatting as a two-digit string
                return sprintf('%03d', $digit);
            })
            ->unique()
            ->filter()
            ->values()
            ->all();

        foreach ($request->input('amounts') as $amount) {
            $twoDigitOfSelected = sprintf('%03d', $amount['num']); // Ensure two-digit format
            if (in_array($twoDigitOfSelected, $closedTwoDigits)) {
                return response()->json(['message' => "3D -  '{$twoDigitOfSelected}'  ကိုပိတ်ထားသောကြောင့် ကံစမ်း၍ မရနိုင်ပါ ၊ ကျေးဇူးပြု၍ ဂဏန်းပြန်ရွှေးချယ်ပါ။ "], 401);
            }
        }


        $result = $this->lottoService->play($totalAmount, $amounts);
        // return response()->json($result);
        if ($result == "Insufficient funds.") {
            $message = "လက်ကျန်ငွေ မလုံလောက်ပါ။";
        } elseif (is_array($result)) {
            // return response()->json($result);
            $digit = [];
            foreach($result as $k => $r){
                $digit[] = ThreeDigit::find($result[$k]+1)->three_digit;
            }
            // return response()->json($digit);
            $d = implode(",",$digit);
            // return response()->json($d);
            $message = $d." ဂဏန်းမှာ သတ်မှတ် Limit ထက်ကျော်လွန်နေပါသည်။";
        } else {
            return $this->success($result);
        }

        return response()->json(['message' => $message], 401);

        // Assuming the service will handle exceptions and return a suitable result.
        // return response()->json(['success' => true, 'message' => 'Bet placed successfully.', 'data' => $result]);
    }

    

//     public function play(Request $request)
// {
//     Log::info($request->all());

//     $validated = $request->validate([
//         'totalAmount' => 'required|numeric|min:1',
//         'amounts' => 'required|array',
//         'amounts.*.num' => 'required|integer',
//         'amounts.*.amount' => 'required|integer|min:1',
//     ]);

//     // Convert total amount based on currency
// //    $totalAmount = $request->currency === 'baht' ? $request->totalAmount * $rate : $request->totalAmount;
//     $totalAmount = $request->totalAmount;

//     DB::beginTransaction();

//     try {
//         $user = Auth::user();
//         $user->balance -= $totalAmount;

//         if ($user->balance < 0) {
//             throw new \Exception('လက်ကျန်ငွေ မလုံလောက်ပါ။');
//         }
//         /** @var \App\Models\User $user */
//         $user->save();
//         $num = str_pad($request->amounts[0]['num'], 3, '0', STR_PAD_LEFT);
//         $sub_amount = $request->amounts[0]['amount'];
//         $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
//             $break = ThreeDDLimit::latest()->first()->three_d_limit;
//             $totalBetAmountdb = DB::table('lotto_three_digit_copy')
//                                ->where('three_digit_id', $three_digit->id)
//                                ->sum('sub_amount');
//             $limit_break = $totalBetAmountdb + $sub_amount;
//             if($limit_break > $break){
//                 return response()->json([
//                     'amount.*.num' => $three_digit->three_digit,
//                     'amounts.*.amount' => $sub_amount,
//                     'message' => 'သတ်မှတ်ထားသော ထိုးငွေပမာဏ ထက်ကျော်လွန်နေပါသည်။'

//                 ]);
//             }
//         // Commission calculation
//         //$commission_percent = DB::table('commissions')->latest()->first();
//         $commission_percent = 0.5;
//         if ($commission_percent && $totalAmount >= 1000) {
//             $commission = ($totalAmount * $commission_percent) / 100;
//             $user->commission_balance += $commission;
//             $user->save();
//         }

//         $lottery = Lotto::create([
//             'total_amount' => $totalAmount,
//             'user_id' => $user->id,
//         ]);

//         $overLimitAmounts = [];
//         foreach ($request->amounts as $item) {
//             $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
//             $sub_amount = $item['amount'];
            
//             $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
//             $break = ThreeDDLimit::latest()->first()->three_d_limit;
//             $totalBetAmount = DB::table('lotto_three_digit_copy')
//                                ->where('three_digit_id', $three_digit->id)
//                                ->sum('sub_amount');
//             $limit_break = $totalBetAmount + $sub_amount;
//             // if($limit_break > $break){
//             //     return response()->json([
//             //         'amount.*.num' => $three_digit->three_digit,
//             //         'amounts.*.amount' => $sub_amount,
//             //         'message' => 'သတ်မှတ်ထားသော ထိုးငွေပမာဏ ထက်ကျော်လွန်နေပါသည်။'

//             //     ]);
//             // }
//             if ($totalBetAmount + $sub_amount <= $break) {
//                 $pivot = new LotteryThreeDigitPivot([
//                     'lotto_id' => $lottery->id,
//                     'three_digit_id' => $three_digit->id,
//                     'sub_amount' => $sub_amount,
//                     'prize_sent' => false,
//                     'currency' => 'mmk'
//                 ]);
//                 $pivot->save();
//             } else {
//                 $withinLimit = $break - $totalBetAmount;
//                 $overLimit = $sub_amount - $withinLimit;

//                 if ($withinLimit > 0) {
//                     $pivotWithin = new LotteryThreeDigitPivot([
//                         'lotto_id' => $lottery->id,
//                         'three_digit_id' => $three_digit->id,
//                         'sub_amount' => $withinLimit,
//                         'prize_sent' => false,
//                         'currency' => 'mmk'
//                     ]);
//                     $pivotWithin->save();
//         //              $overLimitAmounts[] = [
//         //     'num' => $num,
//         //     'amount' => $overLimit,
//         // ];
//                 }
                
//             //     $check_limit = $totalBetAmount + $sub_amount;
//             // if($check_limit > $break){
//             //     return response()->json([
//             //         'amount.*.num' => $three_digit->three_digit,
//             //         'amounts.*.amount' => $sub_amount,
//             //         'message' => 'သတ်မှတ်ထားသော ထိုးငွေပမာဏ ထက်ကျော်လွန်နေပါသည်။'

//             //     ]);
//             // }
//             }
//             // $check_limit = $totalBetAmount + $sub_amount;
//             // if($check_limit > $break){
//             //     return $this->success([
//             //         'message' => 'သတ်မှတ်ထားသော ထိုးငွေပမာဏ ထက်ကျော်လွန်နေပါသည်။'
//             //     ]);
//             // }else{
//             //     $pivot = new LotteryThreeDigitPivot([
//             //         'lotto_id' => $lottery->id,
//             //         'three_digit_id' => $three_digit->id,
//             //         'sub_amount' => $sub_amount,
//             //         'prize_sent' => false,
//             //         'currency' => 'mmk',
//             //     ]);
//             //     $pivot->save();
//             // }
            
//             // $withinLimit = $break - $totalBetAmount;
//             // if($totalBetAmount + $sub_amount > $break) {
//             //     $over = $totalBetAmount + $sub_amount - $break;
//             //     // json dd ($over);
//             //     // return $this->success([
//             //     //     'over' => $over
//             //     // ]);
//             //     $pivot = new ThreeDigitOverLimit([
//             //         'lotto_id' => $lottery->id,
//             //         'three_digit_id' => $three_digit->id,
//             //         'sub_amount' => $over,
//             //         'prize_sent' => false,
//             //         'currency' => 'mmk'
//             //     ]);
//             //     $pivot->save();
               
//             // }
//             // $overLimit = 0;
//             // if($withinLimit < $sub_amount){
//             //     $overLimit = $sub_amount - $withinLimit;
//             // }

//             // if($overLimit > 0){
//             //     $pivot = new ThreeDigitOverLimit([
//             //         'lotto_id' => $lottery->id,
//             //         'three_digit_id' => $three_digit->id,
//             //         'sub_amount' => $overLimit,
//             //         'prize_sent' => false,
//             //         'currency' => 'mmk'
//             //     ]);
//             //     $pivot->save();
//             // }
//         }
//         // if(!empty($overLimitAmounts)){
//         //             return response()->json([
//         //                 'overLimitAmounts' => $overLimitAmounts,
//         //                 'message' => 'သတ်မှတ်ထားသော ထိုးငွေပမာဏ ထက်ကျော်လွန်နေပါသည်။'
//         //             ], 401);
//         //         }
//         // foreach ($request->amounts as $item) {
//         //     $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
//         //     $sub_amount = $item['amount'];
            
//         //     $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
//         //     LotteryThreeDigitPivot::create([
//         //         'lotto_id' => $lottery->id,
//         //         'three_digit_id' => $three_digit->id,
//         //         'sub_amount' => $sub_amount,
//         //         'prize_sent' => false,
//         //         'currency' => 'mmk',
//         //     ]);

//         //     $break = ThreeDDLimit::latest()->first()->three_d_limit;
//         //     $totalBetAmount = DB::table('lotto_three_digit_copy')
//         //                        ->where('three_digit_id', $three_digit->id)
//         //                        ->sum('sub_amount');

//         //     $withinLimit = $break - $totalBetAmount;
//         //     $overLimit = 0;
//         //     if($withinLimit < $sub_amount){
//         //         $overLimit = $sub_amount - $withinLimit;
//         //     }

//         //     if($overLimit > 0){
//         //         $pivot = new ThreeDigitOverLimit([
//         //             'lotto_id' => $lottery->id,
//         //             'three_digit_id' => $three_digit->id,
//         //             'sub_amount' => $overLimit,
//         //             'prize_sent' => false,
//         //             'currency' => 'mmk'
//         //         ]);
//         //         $pivot->save();
//         //     }
//         // }
//         // foreach ($request->amounts as $item) {
//         //     $num = str_pad($item['num'], 3, '0', STR_PAD_LEFT);
//         //     // $sub_amount = $request->currency === 'baht' ? $item['amount'] * $rate : $item['amount'];
//         //     $sub_amount = $item['amount'];
            
//         //     $three_digit = ThreeDigit::where('three_digit', $num)->firstOrFail();
//         //     LotteryThreeDigitPivot::create([
//         //         'lotto_id' => $lottery->id,
//         //         'three_digit_id' => $three_digit->id,
//         //         'sub_amount' => $sub_amount,
//         //         'prize_sent' => false,
//         //         'currency' => 'mmk',
//         //     ]);
//         //     // Check if the bet is over the limit
//         //     $break = ThreeDDLimit::latest()->first()->three_d_limit;
//         //     $totalBetAmount = DB::table('lotto_three_digit_copy')
//         //                        ->where('three_digit_id', $three_digit->id)
//         //                        ->sum('sub_amount');
//         //         Log::info($totalBetAmount);
//         //         $withinLimit = $break - $totalBetAmount;
//         //         $overLimit = $sub_amount - $withinLimit;
//         //         $limit_over = $totalBetAmount + $sub_amount;
//         //         Log::info($limit_over);
//         //         if($limit_over > $break){
//         //             $pivot = new ThreeDigitOverLimit([
//         //                 'lotto_id' => $lottery->id,
//         //                 'three_digit_id' => $three_digit->id,
//         //                 'sub_amount' => $overLimit,
//         //                 'prize_sent' => false,
//         //                 'currency' => 'mmk'
//         //             ]);
//         //             $pivot->save();
//         //         }
                
//         //      // Store every bet in the LotteryThreeDigitPivot model
//         //     // if($totalBetAmount + $sub_amount <= $break){
//         //     //     $pivot = new LotteryThreeDigitPivot([
//         //     //     'lotto_id' => $lottery->id,
//         //     //     'three_digit_id' => $three_digit->id,
//         //     //     'sub_amount' => $sub_amount,
//         //     //     'prize_sent' => false
//         //     // ]);
//         //     // $pivot->save();
//         //     // }else{
//         //     //     $withinLimit = $break - $totalBetAmount;
//         //     //     $overLimit = $sub_amount - $withinLimit;
//         //     //     if($withinLimit > 0){
//         //     //         $pivot = new LotteryThreeDigitPivot([
//         //     //             'lotto_id' => $lottery->id,
//         //     //             'three_digit_id' => $three_digit->id,
//         //     //             'sub_amount' => $withinLimit,
//         //     //             'prize_sent' => false
//         //     //         ]);
//         //     //         $pivot->save();
//         //     //     }
//         //     //     if($overLimit > 0){
//         //     //         $overLimit = new ThreeDigitOverLimit([
//         //     //             'lotto_id' => $lottery->id,
//         //     //             'three_digit_id' => $three_digit->id,
//         //     //             'sub_amount' => $overLimit
//         //     //         ]);
//         //     //         $overLimit->save();
//         //     //     }
//         //     // }
//         // }

//         DB::commit();
//         return $this->success([
//             'message' => 'Bet placed successfully.'
//         ]);
//     } catch (\Exception $e) {
//         DB::rollback();
//         Log::error('Error in play method: ' . $e->getMessage());
//         Log::error($e->getTraceAsString()); // Log the stack trace
//         return response()->json(['success' => false, 'message' => $e->getMessage()], 401);
//     }
//     }
    // three once week history
     public function OnceWeekThreedigitHistoryConclude()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayThreeDDigit = User::getAdminthreeDigitsHistoryApi($userId);
       // $three_limits = ThreeDDLimit::orderBy('id', 'desc')->first();
       return $this->success($displayThreeDDigit);
    }

     // three once week history
     public function OnceMonthThreedigitHistoryConclude()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayThreeDDigit = User::getAdminthreeDigitsOneMonthHistoryApi($userId);
       // $three_limits = ThreeDDLimit::orderBy('id', 'desc')->first();
       return $this->success($displayThreeDDigit);
    }


    // three once month history
    public function OnceMonthThreeDHistory()
    {
        $userId = auth()->id(); // Get logged in user's ID
        $displayThreeDDigit = User::getUserOneMonthThreeDigits($userId);
        return $this->success($displayThreeDDigit);
    }
}