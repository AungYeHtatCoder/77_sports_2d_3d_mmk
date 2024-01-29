<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwoDigit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// public function index()
// {
//     $twoDigits = TwoDigit::all();
//     $client = new Client();
    
//     // Data from 'https://api.thaistock2d.com/live'
//     try {
//         $responseLive = $client->request('GET', 'https://api.thaistock2d.com/live');
//         $data = json_decode($responseLive->getBody(), true);
//     } catch (RequestException $e) {
//         $data = []; // or provide a default value
//     }

//     // Data from 'https://api.thaistock2d.com/2d_result'
//     $latestResultToday = [];
//     try {
//         $responseResult = $client->request('GET', 'https://api.thaistock2d.com/2d_result');
//         $dataResult = json_decode($responseResult->getBody(), true);

//         // Assuming the results are sorted by date, get the first entry for today
//         $todayData = $dataResult[0];

//         // From today's data, get the last child entry
//         $latestResultToday = end($todayData['child']);
//     } catch (RequestException $e) {
//         // Handle exception if needed
//     }
    
//     if (request()->ajax()) {
//         return response()->json(['live' => $data, 'latestResultToday' => $latestResultToday]);
//     }

//     return view('welcome', compact('twoDigits', 'data', 'latestResultToday'));
// }


public function index()
{
    //$twoDigits = TwoDigit::all();
    $client = new Client();
    
    try {
        $response = $client->request('GET', 'https://api.thaistock2d.com/live');
        $data = json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        // Log the error or inform the user
        $data = []; // or provide a default value
    }
    if (request()->ajax()) {
        return response()->json($data);
    }

    return view('welcome', compact('data'));
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
//     // return response()->json([
//     //         'success' => true,
//     //         'message' => 'Data stored successfully!'
//     //     ]);
//     // } catch (\Exception $e) {
//     //     DB::rollback();
//     //     return response()->json([
//     //         'success' => false,
//     //         'error' => $e->getMessage()
//     //     ]);
//     // }
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

    public function userProfile(){
        return view('user_profile');
    }
}