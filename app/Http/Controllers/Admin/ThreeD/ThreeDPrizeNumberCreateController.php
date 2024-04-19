<?php

namespace App\Http\Controllers\Admin\ThreeD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ThreeDigit\Permutation;
use App\Models\ThreeDigit\ThreeWinner;
use App\Models\ThreeDigit\FirstPrizeWinner;
use App\Models\ThreeDigit\ThirdPrizeWinner;
use App\Models\ThreeDigit\SecondPrizeWinner;

class ThreeDPrizeNumberCreateController extends Controller
{
     public function __construct()
    {
        date_default_timezone_set('Asia/Yangon');
    }
    public function index()
    {
        
        $three_digits_prize = ThreeWinner::orderBy('id', 'desc')->first();
        $permutation_digits = Permutation::all();
        return view('admin.three_d.prize_index', compact('three_digits_prize', 'permutation_digits'));
    }

    

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    //$currentSession = date('H') < 12 ? 'morning' : 'evening';  // before 1 pm is morning

        ThreeWinner::create([
            'prize_no' => $request->prize_no,
            //'session' => $currentSession,
        ]);
        session()->flash('SuccessRequest', 'Three Digit Lottery Prize Number Created Successfully');

        return redirect()->back()->with('success', 'Three Digit Lottery Prize Number Created Successfully');
    }

     public function PermutationStore(Request $request)
    {
        // Logic to store permutations in the database
        if ($request->has('permutations')) {
            foreach ($request->permutations as $permutation) {
                Permutation::create(['digit' => $permutation]);
            }
            return redirect()->back()->with('success', 'Permutations stored successfully.');
        } else {
            return redirect()->back()->with('error', 'No permutations to store.');
        }
    }

    // deletePermutation
    public function deletePermutation($id)
    {
        $permutation = Permutation::find($id);
        if ($permutation) {
            $permutation->delete();
            return redirect()->back()->with('success', 'Permutation deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Permutation not found.');
        }
    }

    public function getFirstPrizeWinnersWithUserInfo()
{
    $winners = DB::table('lotto_three_digit_pivot')
        ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
        ->join('users', 'lottos.user_id', '=', 'users.id')
        ->where('lotto_three_digit_pivot.prize_sent', '=', 1)
        //->orWhere('lotto_three_digit_pivot.prize_sent', '=', 2)
        //->orWhere('lotto_three_digit_pivot.prize_sent', '=', 3)
        ->select(
            'lottos.user_id',
            'users.name',
            'users.phone',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.three_digit_id',
            'lotto_three_digit_pivot.bet_digit',
            'lotto_three_digit_pivot.sub_amount',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.created_at'
        )
        ->get();
        $prizes = FirstPrizeWinner::orderBy('id', 'desc')->get();
        $totalPrizeAmount = FirstPrizeWinner::sum('prize_amount');
        
    return view('admin.three_d.first_prize_winner', compact('winners', 'prizes', 'totalPrizeAmount'));
}

    public function getSecondPrizeWinnersWithUserInfo()
{
    $winners = DB::table('lotto_three_digit_pivot')
        ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
        ->join('users', 'lottos.user_id', '=', 'users.id')
        ->where('lotto_three_digit_pivot.prize_sent', '=', 2)
        //->orWhere('lotto_three_digit_pivot.prize_sent', '=', 2)
        //->orWhere('lotto_three_digit_pivot.prize_sent', '=', 3)
        ->select(
            'lottos.user_id',
            'users.name',
            'users.phone',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.three_digit_id',
            'lotto_three_digit_pivot.bet_digit',
            'lotto_three_digit_pivot.sub_amount',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.created_at'
        )
        ->get();
        $prizes = SecondPrizeWinner::orderBy('id', 'desc')->get();
        $totalPrizeAmount = SecondPrizeWinner::sum('prize_amount');
        
    return view('admin.three_d.second_prize_winner', compact('winners', 'prizes', 'totalPrizeAmount'));
}

    public function getThirdPrizeWinnersWithUserInfo()
{
    $winners = DB::table('lotto_three_digit_pivot')
        ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
        ->join('users', 'lottos.user_id', '=', 'users.id')
        ->where('lotto_three_digit_pivot.prize_sent', '=', 3)
        //->orWhere('lotto_three_digit_pivot.prize_sent', '=', 2)
        //->orWhere('lotto_three_digit_pivot.prize_sent', '=', 3)
        ->select(
            'lottos.user_id',
            'users.name',
            'users.phone',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.three_digit_id',
            'lotto_three_digit_pivot.bet_digit',
            'lotto_three_digit_pivot.sub_amount',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.created_at'
        )
        ->get();
        $prizes = ThirdPrizeWinner::orderBy('id', 'desc')->get();
        $totalPrizeAmount = ThirdPrizeWinner::sum('prize_amount');
        
    return view('admin.three_d.third_prize_winner', compact('winners', 'prizes', 'totalPrizeAmount'));
}

    public function storeFirstPrizeWinners(Request $request)
    {
        $winners = DB::table('lotto_three_digit_pivot')
            ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
            ->join('users', 'lottos.user_id', '=', 'users.id')
            ->where('lotto_three_digit_pivot.prize_sent', '=', 1)
            ->select(
                'lottos.user_id',
                'users.name',
                'users.phone',
                'lotto_three_digit_pivot.prize_sent',
                'lotto_three_digit_pivot.three_digit_id',
                'lotto_three_digit_pivot.bet_digit',
                'lotto_three_digit_pivot.sub_amount',
                'lotto_three_digit_pivot.prize_sent',
                'lotto_three_digit_pivot.created_at'
            )
            ->get();
        foreach ($winners as $winnerData) {
            FirstPrizeWinner::create([
                'user_id' => $winnerData->user_id,
                'user_name' => $winnerData->name,
                'phone' => $winnerData->phone,
                'bet_digit' => $winnerData->bet_digit,
                'sub_amount' => $winnerData->sub_amount,
                'prize_amount' => $winnerData->sub_amount * 600,
                'status' => $winnerData->prize_sent
            ]);
        }

         return redirect()->back()->with('success', 'Fifrst Prize Winners data stored successfully');
    }

    public function storeSecondPrizeWinners(Request $request)
    {
        $winners = DB::table('lotto_three_digit_pivot')
            ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
            ->join('users', 'lottos.user_id', '=', 'users.id')
            ->where('lotto_three_digit_pivot.prize_sent', '=', 2)
            ->select(
                'lottos.user_id',
                'users.name',
                'users.phone',
                'lotto_three_digit_pivot.prize_sent',
                'lotto_three_digit_pivot.three_digit_id',
                'lotto_three_digit_pivot.bet_digit',
                'lotto_three_digit_pivot.sub_amount',
                'lotto_three_digit_pivot.prize_sent',
                'lotto_three_digit_pivot.created_at'
            )
            ->get();
        foreach ($winners as $winnerData) {
            SecondPrizeWinner::create([
                'user_id' => $winnerData->user_id,
                'user_name' => $winnerData->name,
                'phone' => $winnerData->phone,
                'bet_digit' => $winnerData->bet_digit,
                'sub_amount' => $winnerData->sub_amount,
                'prize_amount' => $winnerData->sub_amount * 10,
                'status' => $winnerData->prize_sent
            ]);
        }

         return redirect()->back()->with('success', 'Second Prize Winners data stored successfully');
    }


    public function storeThirdPrizeWinners(Request $request)
    {
        $winners = DB::table('lotto_three_digit_pivot')
            ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
            ->join('users', 'lottos.user_id', '=', 'users.id')
            ->where('lotto_three_digit_pivot.prize_sent', '=', 3)
            ->select(
                'lottos.user_id',
                'users.name',
                'users.phone',
                'lotto_three_digit_pivot.prize_sent',
                'lotto_three_digit_pivot.three_digit_id',
                'lotto_three_digit_pivot.bet_digit',
                'lotto_three_digit_pivot.sub_amount',
                'lotto_three_digit_pivot.prize_sent',
                'lotto_three_digit_pivot.created_at'
            )
            ->get();
        foreach ($winners as $winnerData) {
            ThirdPrizeWinner::create([
                'user_id' => $winnerData->user_id,
                'user_name' => $winnerData->name,
                'phone' => $winnerData->phone,
                'bet_digit' => $winnerData->bet_digit,
                'sub_amount' => $winnerData->sub_amount,
                'prize_amount' => $winnerData->sub_amount * 10,
                'status' => $winnerData->prize_sent
            ]);
        }

         return redirect()->back()->with('success', 'Third Prize Winners data stored successfully');
    }

    public function updateFirstPrizeWinners(Request $request)
{
    // Retrieve the winners whose prize_sent is 1
    $winners = DB::table('lotto_three_digit_pivot')
        ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
        ->join('users', 'lottos.user_id', '=', 'users.id')
        ->where('lotto_three_digit_pivot.prize_sent', '=', 1)
        ->select(
            'lotto_three_digit_pivot.id', // Include the primary key of the pivot table
            'users.name',
            'users.phone',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.three_digit_id',
            'lotto_three_digit_pivot.bet_digit',
            'lotto_three_digit_pivot.sub_amount',
            'lotto_three_digit_pivot.created_at'
        )
        ->get();

    // Update the prize_sent column for the winners
    foreach ($winners as $winnerData) {
        DB::table('lotto_three_digit_pivot')
            ->where('id', $winnerData->id) // Use the primary key to identify the row
            ->update(['prize_sent' => 0]);
    }

    return redirect()->back()->with('success', 'Winners data updated successfully');
}

    public function updateSecondPrizeWinners(Request $request)
{
    // Retrieve the winners whose prize_sent is 1
    $winners = DB::table('lotto_three_digit_pivot')
        ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
        ->join('users', 'lottos.user_id', '=', 'users.id')
        ->where('lotto_three_digit_pivot.prize_sent', '=', 2)
        ->select(
            'lotto_three_digit_pivot.id', // Include the primary key of the pivot table
            'users.name',
            'users.phone',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.three_digit_id',
            'lotto_three_digit_pivot.bet_digit',
            'lotto_three_digit_pivot.sub_amount',
            'lotto_three_digit_pivot.created_at'
        )
        ->get();

    // Update the prize_sent column for the winners
    foreach ($winners as $winnerData) {
        DB::table('lotto_three_digit_pivot')
            ->where('id', $winnerData->id) // Use the primary key to identify the row
            ->update(['prize_sent' => 0]);
    }

    return redirect()->back()->with('success', 'Winners data updated successfully');
}


    public function updateThirdPrizeWinners(Request $request)
{
    // Retrieve the winners whose prize_sent is 1
    $winners = DB::table('lotto_three_digit_pivot')
        ->join('lottos', 'lotto_three_digit_pivot.lotto_id', '=', 'lottos.id')
        ->join('users', 'lottos.user_id', '=', 'users.id')
        ->where('lotto_three_digit_pivot.prize_sent', '=', 3)
        ->select(
            'lotto_three_digit_pivot.id', // Include the primary key of the pivot table
            'users.name',
            'users.phone',
            'lotto_three_digit_pivot.prize_sent',
            'lotto_three_digit_pivot.three_digit_id',
            'lotto_three_digit_pivot.bet_digit',
            'lotto_three_digit_pivot.sub_amount',
            'lotto_three_digit_pivot.created_at'
        )
        ->get();

    // Update the prize_sent column for the winners
    foreach ($winners as $winnerData) {
        DB::table('lotto_three_digit_pivot')
            ->where('id', $winnerData->id) // Use the primary key to identify the row
            ->update(['prize_sent' => 0]);
    }

    return redirect()->back()->with('success', 'Winners data updated successfully');
}



}