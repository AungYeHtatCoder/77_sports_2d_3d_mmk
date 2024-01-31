<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\CashRequest;
use App\Models\Admin\CashOutRequest;
use App\Models\Admin\Currency;
use App\Models\Admin\TransferLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use NunoMaduro\Collision\Provider;

class CashOutRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashes = CashOutRequest::latest()->get();
        return view('admin.cash_requests.cash_out', compact('cashes'));
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
        $request->validate([
            'payment_method' => 'required',
            'amount' => 'required|numeric',
            'phone' => 'required|numeric',
            'name' => 'required|string',
            'currency' => 'required'
        ]);

        if($request->amount > auth()->user()->balance){
            return redirect()->back()->with('error', 'Insufficient balance');
        }
        CashOutRequest::create([
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'name' => $request->name,
            'user_id' => auth()->id(),
            'currency' => 'mmk',
        ]);
        TransferLog::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
            'type' => 'Withdraw',
            'created_by' => null
        ]);
        $user = User::find(auth()->id());
        $user->balance -= $request->amount;
        $user->save();
        
        $toMail = "delightdeveloper4@gmail.com";
        
        $mail = [
            'status' => "Withdraw",
            'name' => $user->name,
            'receiver' => $request->name,
            'balance' => $user->balance,
            'payment_method'=> $request->payment_method,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'rate' => 1,
        ];
        // return $message;
        Mail::to($toMail)->send(new CashRequest($mail));
        return redirect()->back()->with('success', 'Withdraw request submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cash = CashOutRequest::find($id);
        return view('admin.cash_requests.cash_out_detail', compact('cash'));
    }

    public function accept($id)
    {
        $cash = CashOutRequest::find($id);
        $cash->status = 1;
        $cash->save();

        $log = TransferLog::where('user_id', $cash->user_id)
        ->where('created_at', $cash->created_at)
        ->first();

        $log->update([
            'status' => 1,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with('toast_success', 'Filled the cash into user successfully');
    }

    public function reject($id)
    {
        $cash = CashOutRequest::find($id);
        $amount = $cash->amount;

        User::where('id', $cash->user_id)->increment('balance', $amount);

        $cash->status = 2;
        $cash->save();

        $log = TransferLog::where('user_id', $cash->user_id)
        ->where('created_at', $cash->created_at)
        ->first();

        $log->update([
            'status' => 2,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->back()->with('toast_success', 'Filled the cash into user successfully');
    }

    

    // public function withdraw(Request $request, $id)
    // {
    //     $request->validate([
    //         'amount' => 'required|numeric',
    //         'currency' => 'required|string'
    //     ]);
    //     $user = User::find($id);
    //     if($request->currency == 'kyat')
    //     {
    //         $user->balance -= $request->amount;
    //         TransferLog::create([
    //             'user_id' => $user->id,
    //             'amount' => $request->amount,
    //             'status' => "withdraw",
    //             'created_by' => auth()->user()->id,
    //         ]);
    //     }else{
    //         $rate = Currency::latest()->first()->rate;
    //         $user->balance -= $request->amount * $rate;
    //         TransferLog::create([
    //             'user_id' => $user->id,
    //             'amount' => $request->amount * $rate,
    //             'status' => "withdraw",
    //             'created_by' => auth()->user()->id,
    //         ]);
    //     }
    //     $user->save();
    //     return redirect()->back()->with('success', 'Withdraw the cash from user successfully');
    // }
}
