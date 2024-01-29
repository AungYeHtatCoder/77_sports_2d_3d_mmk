<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ThreedLottery;
use App\Models\Admin\ThreedLotteryEntry;
class ThreedHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{
    // Retrieve all ThreedLotteries with their related user, lotteryMatch, entries, and threedMatchTimes
    // Order by descending ID
    $threedLotteries = ThreedLottery::with(['user', 'lotteryMatch', 'entries', 'threedMatchTimes'])
        ->orderBy('id', 'desc')
        ->get();

    // Pass the data to the view
    return view('admin.three_d.three_d_history_index', compact('threedLotteries'));
}
//     public function index()
// {
//     // Retrieve all records with their relationships
//     $threedLotteries = ThreedLottery::with(['user', 'lotteryMatch', 'entries'])
//                         ->orderBy('id', 'desc')
//                         ->get();

//     // Return the data to the view
//     return view('admin.three_d.three_d_history_index', compact('threedLotteries'));
// }


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