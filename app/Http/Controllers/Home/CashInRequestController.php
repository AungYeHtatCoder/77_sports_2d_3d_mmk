<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\CashRequest;
use App\Models\Admin\CashInRequest;
use App\Models\Admin\Currency;
use App\Models\Admin\TransferLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CashInRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashes = CashInRequest::latest()->get();
        return view('admin.cash_requests.cash_in', compact('cashes'));
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
        $rate = Currency::latest()->first()->rate;
        $request->validate([
            'payment_method' => 'required',
            'last_6_num' => 'required',
            'amount' => 'required|numeric',
            'phone' => 'required|numeric',
            'currency' => 'required|string',
        ]);
        CashInRequest::create([
            'payment_method' => $request->payment_method,
            'last_6_num' => $request->last_6_num,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'currency' => $request->currency,
            'user_id' => auth()->user()->id,
        ]);
        TransferLog::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->currency == "baht" ? $request->amount * $rate : $request->amount,
            'type' => 'Deposit',
            'created_by' => null
        ]);
        $user = User::find(auth()->id());
       
        $toMail = "delightdeveloper4@gmail.com";
        $mail = [
            'status' => "Deposit",
            'name' => $user->name,
            'balance' => $user->balance,
            'payment_method'=> $request->payment_method,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'last_6_num' => $request->last_6_num,
            'currency' => $request->currency,
            'rate' => $rate,
        ];
        Mail::to($toMail)->send(new CashRequest($mail));
        return redirect()->back()->with('success', 'Cash In Request Submitted Successfully');
    }

    // public function show($id)
    // {
    //     $cash = CashInRequest::find($id);
    //     return view('admin.cash_requests.cash_in_detail', compact('cash'));
    // }

    public function accept($id)
    {
        $cash = CashInRequest::find($id);
        $amount = $cash->amount;

        User::where('id', $cash->user_id)->increment('balance', $amount);

        $cash->status = 1;
        $cash->save();

        $log = TransferLog::where('user_id', $cash->user_id)
        ->where('created_at', $cash->created_at)
        ->first();

        $log->update([
            'status' => 1,
            'created_by' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Filled the cash into user successfully');
    }

    public function reject($id)
    {
        $cash = CashInRequest::find($id);
        $cash->status = 2;
        $cash->save();

        $log = TransferLog::where('user_id', $cash->user_id)
        ->where('created_at', $cash->created_at)
        ->first();

        $log->update([
            'status' => 2,
            'created_by' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Filled the cash into user successfully');
    }

    // public function transfer(Request $request, $id)
    // {
    //     $request->validate([
    //         'amount' => 'required|numeric',
    //         'currency' => 'required|string'
    //     ]);
    //     $user = User::find($id);
    //     if($request->currency == 'kyat')
    //     {
    //         $user->balance += $request->amount;
    //         TransferLog::create([
    //             'user_id' => $user->id,
    //             'amount' => $request->amount,
    //             'status' => "deposit",
    //             'created_by' => auth()->user()->id,
    //         ]);
    //     }else{
    //         $rate = Currency::latest()->first()->rate;
    //         $user->balance += $request->amount * $rate;
    //         TransferLog::create([
    //             'user_id' => $user->id,
    //             'amount' => $request->amount * $rate,
    //             'status' => "deposit",
    //             'created_by' => auth()->user()->id,
    //         ]);
    //     }
    //     $user->save();
    //     return redirect()->back()->with('success', 'Transfered the cash into user successfully');
    // }
}
