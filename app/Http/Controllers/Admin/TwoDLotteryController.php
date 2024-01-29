<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Http\Controllers\Controller;
use App\Models\Admin\TwodWiner;
use Carbon\Carbon;

class TwoDLotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{
    $lotteries = Lottery::with('twoDigits')->orderBy('id', 'desc')->get();
    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    return view('admin.two_d.two_d_history', compact('lotteries', 'prize_no'));
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
        $lottery = Lottery::with('twoDigits')->findOrFail($id);
        $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        return view('admin.two_d.two_history_show', compact('lottery', 'prize_no'));
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

/*
    $startOfDay = Carbon::now()->startOfDay();
    $endOfDay = Carbon::now()->endOfDay();

    // Determine AM or PM
    $currentMeridiem = Carbon::now()->format('A');  // This will return either "AM" or "PM"

    // Find the prize_no based on today's date and AM/PM
    $prize_no = TwodWiner::whereBetween('created_at', [$startOfDay, $endOfDay])
                         ->where('prize_no', 'LIKE', '%' . $currentMeridiem . '%')
                         ->first();
    */