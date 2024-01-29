<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\FillBalance;
use App\Http\Controllers\Controller;

class FillBalanceReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get balance request list order by latest 
        $balance_requests = FillBalance::orderBy('created_at', 'desc')->get();
        return view('admin.fill_balance.index', compact('balance_requests'));
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
        $balance = FillBalance::findOrFail($id);
        return view('admin.fill_balance.show', compact('balance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $balance = FillBalance::findOrFail($id);
        return view('admin.fill_balance.edit', compact('balance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // 1. Validate the data
    $data = $request->validate([
        'balance' => 'required|numeric',
        'status' => 'required|numeric', // Assuming you want to validate it as a number
    ]);

    // Retrieve the fill balance record
    $fillBalance = FillBalance::findOrFail($id);

    // 2. Retrieve the user
    $user = $fillBalance->user;

    // 3. Update user's balance column (assuming you're adding to the existing balance)
    $user->balance += $data['balance'];
    $user->save();

    // 4. Update the status of fill_balances table
    $fillBalance->status = $data['status'];
    $fillBalance->save();

    // Return or redirect as per your requirement
    return back()->with('success', 'Balance and Status updated successfully!');
}
    //  public function update(Request $request, $id)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'status' => 'required|in:0,1',
    //     ]);

    //     // Retrieve the balance
    //     $balance = FillBalance::findOrFail($id);

    //     // Update the status
    //     $balance->status = $request->status;
    //     $balance->save();

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Status updated successfully.');
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}