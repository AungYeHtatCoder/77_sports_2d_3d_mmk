<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwodWiner;
use App\Http\Controllers\Controller;

class TwoDMorningWinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // for two digit early morning
    public function TwoDEarlyMorningWinner()
    {
        $lotteries = Lottery::with('twoDigitsEarlyMorning')->get();

        $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                     ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(6), Carbon::now()->startOfDay()->addHours(10)])
                                     ->orderBy('id', 'desc')
                                     ->first();
       
                                     $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        return view('admin.two_d.early_morning_winner', compact('lotteries', 'prize_no_morning', 'prize_no'));
    }
    
    public function TwoDMorningWinner()
{
    $lotteries = Lottery::with('twoDigitsMorning')->get();

    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                 ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(6), Carbon::now()->startOfDay()->addHours(12)])
                                 ->orderBy('id', 'desc')
                                 ->first();
   
                                 $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    return view('admin.two_d.morining_winner', compact('lotteries', 'prize_no_morning', 'prize_no'));
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
        //
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