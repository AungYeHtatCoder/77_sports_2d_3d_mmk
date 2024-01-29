<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Withdraw;
use Illuminate\Http\Request;

class WithDrawViewController extends Controller
{
    public function index()
    {
        // get balance request list order by latest 
        $balance_requests = Withdraw::orderBy('created_at', 'desc')->get();
        return view('admin.withdraw.index', compact('balance_requests'));
    }

    public function show(string $id)
    {
        $balance = Withdraw::findOrFail($id);
        return view('admin.withdraw.show', compact('balance'));
    }

     public function update(Request $request, $id)
{
    // 1. Validate the data
    $data = $request->validate([
        // status can be either 'pending' or 'accept' or 'rejected'
        'status' => 'required|in:pending,accept,reject',
    ]);
    // Retrieve the fill balance record
    $fillBalance = Withdraw::findOrFail($id);
    // 4. Update the status of fill_balances table
    $fillBalance->status = $data['status'];
    $fillBalance->save();

    // Return or redirect as per your requirement
    return back()->with('success', 'Balance and Status updated successfully!');
}

}