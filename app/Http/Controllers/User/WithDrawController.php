<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Withdraw;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WithDrawController extends Controller
{
    public function GetWithdraw()
    {
        return view('two_d.withdraw');
    }
    public function UserKpayWithdrawMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('kpay_no')->first();
        return view('two_d.k_pay_withdraw', compact('user'));
    }
    public function UserCBPayWithdrawMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('cbpay_no')->first();
        return view('two_d.cb_pay_withdraw', compact('user'));
        
        
    }

    public function UserWavePayWithdrawMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('wavepay_no')->first();
        return view('two_d.wave_pay_withdraw', compact('user'));
        
        
    }
    public function UserAYAPayWithdrawMoney()
    {
        // user id 1 is admin rethrive from database where kpay_no is not null
        $user = User::where('id', 1)->whereNotNull('ayapay_no')->first();
        return view('two_d.aya_pay_withdraw', compact('user'));
        
        
    }

    public function StoreKpayWithdrawMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'kpay_no' => 'required|numeric',
            'user_ph_no' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $user = Auth::user();
        $user->balance -= $request->amount;

        if ($user->balance < 0) {
            throw new \Exception('Your balance is not enough to widthdraw.');
        }

        $user->save();
        // Create a new FillBalance record
        $fillBalance = new Withdraw();
        $fillBalance->user_id = Auth::id();
        $fillBalance->kpay_no = $request->kpay_no;
        $fillBalance->user_ph_no = $request->user_ph_no;
        $fillBalance->amount = $request->amount;
        $fillBalance->status = 'pending';  // default to 'pending'

        $fillBalance->save();
        session()->flash('SuccessRequest', 'သင့်အကောင့်သို့ငွေထုတ်ရန်တောင်းဆိုပြီးပါပီး . သင့်ထုတ်ယူသည့်ငွေပမာဏ - '.$request->amount.' MMK . ၁၀ မိနစ်အတွင်း သင့်အကောင့်သို့ ထုတ်ယူသည့်ငွေအား လွဲပေးသွားပါမည်--- please wait for 10 minutes to get your money. Thank you!');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreCBpayWithdrawMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'cbpay_no' => 'required|numeric',
            'user_ph_no' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $user = Auth::user();
        $user->balance -= $request->amount;

        if ($user->balance < 0) {
            throw new \Exception('Your balance is not enough to widthdraw.');
        }
        $user->save();

        // Create a new FillBalance record
        $fillBalance = new Withdraw();
        $fillBalance->user_id = Auth::id();
        $fillBalance->cbpay_no = $request->cbpay_no;
        $fillBalance->user_ph_no = $request->user_ph_no;
        $fillBalance->amount = $request->amount;
        $fillBalance->status = 'pending';  // default to 'pending'

        $fillBalance->save();
         session()->flash('SuccessRequest', 'သင့်အကောင့်သို့ငွေထုတ်ရန်တောင်းဆိုပြီးပါပီး . သင့်ထုတ်ယူသည့်ငွေပမာဏ - '.$request->amount.' MMK . ၁၀ မိနစ်အတွင်း သင့်အကောင့်သို့ ထုတ်ယူသည့်ငွေအား လွဲပေးသွားပါမည်--- please wait for 10 minutes to get your money. Thank you!');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreWavepayWithdrawMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'wavepay_no' => 'required|numeric',
            'user_ph_no' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $user = Auth::user();
        $user->balance -= $request->amount;

        if ($user->balance < 0) {
            throw new \Exception('Your balance is not enough to widthdraw.');
        }
        $user->save();

        // Create a new FillBalance record
        $fillBalance = new Withdraw();
        $fillBalance->user_id = Auth::id();
        $fillBalance->wavepay_no = $request->wavepay_no;
        $fillBalance->user_ph_no = $request->user_ph_no;
        $fillBalance->amount = $request->amount;
        $fillBalance->status = 'pending';  // default to 'pending'

        $fillBalance->save();
         session()->flash('SuccessRequest', 'သင့်အကောင့်သို့ငွေထုတ်ရန်တောင်းဆိုပြီးပါပီး . သင့်ထုတ်ယူသည့်ငွေပမာဏ - '.$request->amount.' MMK . ၁၀ မိနစ်အတွင်း သင့်အကောင့်သို့ ထုတ်ယူသည့်ငွေအား လွဲပေးသွားပါမည်--- please wait for 10 minutes to get your money. Thank you!');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function StoreAYApayWithdrawMoney(Request $request)
    {
        // Validate the request
        $request->validate([
            'ayapay_no' => 'required|numeric',
            'user_ph_no' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $user = Auth::user();
        $user->balance -= $request->amount;

        if ($user->balance < 0) {
            throw new \Exception('Your balance is not enough to widthdraw.');
        }
        $user->save();

        // Create a new FillBalance record
        $fillBalance = new Withdraw();
        $fillBalance->user_id = Auth::id();
        $fillBalance->ayapay_no = $request->ayapay_no;
        $fillBalance->user_ph_no = $request->user_ph_no;
        $fillBalance->amount = $request->amount;
        $fillBalance->status = 'pending';  // default to 'pending'

        $fillBalance->save();
        session()->flash('SuccessRequest', 'သင့်အကောင့်သို့ငွေထုတ်ရန်တောင်းဆိုပြီးပါပီး . သင့်ထုတ်ယူသည့်ငွေပမာဏ - '.$request->amount.' MMK . ၁၀ မိနစ်အတွင်း သင့်အကောင့်သို့ ထုတ်ယူသည့်ငွေအား လွဲပေးသွားပါမည်--- please wait for 10 minutes to get your money. Thank you!');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }
}