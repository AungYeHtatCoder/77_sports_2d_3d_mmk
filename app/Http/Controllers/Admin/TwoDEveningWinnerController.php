<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Lottery;
use App\Models\Admin\TwodWiner;
use App\Http\Controllers\Controller;

class TwoDEveningWinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function TwoDEveningWinner()
{
    $lotteries = Lottery::with('twoDigitsEvening')->get();
    $prize_no_afternoon = TwodWiner::whereDate('created_at', Carbon::today())
                                   ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(12), Carbon::now()->startOfDay()->addHours(23)])
                                   ->orderBy('id', 'desc')
                                   ->first();
    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
    return view('admin.two_d.evening_winner', compact('lotteries', 'prize_no_afternoon', 'prize_no'));
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