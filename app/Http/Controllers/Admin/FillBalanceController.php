<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\FillBalance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FillBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function UserKpayFillMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('kpay_no')->first();
        return view('kpay_fill_money', compact('user'));
        
        
    }

    public function UserCBPayFillMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('cbpay_no')->first();
        return view('cbpay_fill_money', compact('user'));
        
        
    }

    public function UserWavePayFillMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('wavepay_no')->first();
        return view('wavepay_no_fill_money', compact('user'));
        
        
    }
    public function UserAYAPayFillMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('ayapay_no')->first();
        return view('ayapay_no_fill_money', compact('user'));
        
        
    }

    public function StoreKpayFillMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'kpay_no' => 'required|numeric',
            'last_six_digit' => 'required|string|max:6|min:6'
        ]);

        // Create a new FillBalance record
        $fillBalance = new FillBalance();
        $fillBalance->user_id = Auth::id();
        $fillBalance->kpay_no = $request->kpay_no;
        $fillBalance->last_six_digit = $request->last_six_digit;
        $fillBalance->status = 0;  // default to 'pending'

        $fillBalance->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreCBpayFillMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'cbpay_no' => 'required|numeric',
            'last_six_digit' => 'required|string|max:6|min:6'
        ]);

        // Create a new FillBalance record
        $fillBalance = new FillBalance();
        $fillBalance->user_id = Auth::id();
        $fillBalance->cbpay_no = $request->cbpay_no;
        $fillBalance->last_six_digit = $request->last_six_digit;
        $fillBalance->status = 0;  // default to 'pending'

        $fillBalance->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreWavepayFillMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'wavepay_no' => 'required|numeric',
            'last_six_digit' => 'required|string|max:6|min:6'
        ]);

        // Create a new FillBalance record
        $fillBalance = new FillBalance();
        $fillBalance->user_id = Auth::id();
        $fillBalance->wavepay_no = $request->wavepay_no;
        $fillBalance->last_six_digit = $request->last_six_digit;
        $fillBalance->status = 0;  // default to 'pending'

        $fillBalance->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreAYApayFillMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'ayapay_no' => 'required|numeric',
            'last_six_digit' => 'required|string|max:6|min:6'
        ]);

        // Create a new FillBalance record
        $fillBalance = new FillBalance();
        $fillBalance->user_id = Auth::id();
        $fillBalance->ayapay_no = $request->ayapay_no;
        $fillBalance->last_six_digit = $request->last_six_digit;
        $fillBalance->status = 0;  // default to 'pending'

        $fillBalance->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
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