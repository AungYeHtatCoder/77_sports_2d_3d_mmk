<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Admin\Bank;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function wallet()
    {
        return view('frontend.wallet');
    }

    public function topUp($id)
    {
        $bank = Bank::find($id);
        return view('frontend.topup', compact('bank'));
    }

    public function topUpBank()
    {
        $banks = Bank::all();
        return view('frontend.topUp-bank', compact('banks'));
    }

    public function withDrawBank()
    {
        $banks = Bank::all();
        return view('frontend.withdraw-bank', compact('banks'));
    }
    public function withDraw($id)
    {
        $bank = Bank::find($id);
        return view('frontend.withdraw', compact('bank'));
    }
}
