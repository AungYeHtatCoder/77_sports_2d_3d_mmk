<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TransferLog;
use Illuminate\Http\Request;

class TransferLogController extends Controller
{
    public function index()
    {
        $logs = TransferLog::latest()->get();
        return view('admin.cash_requests.transferlog', compact('logs'));
    }

    public function mylogs()
    {
        $logs = TransferLog::where('user_id', auth()->user()->id)->latest()->take(20)->get();
        return view('frontend.transferlog', compact('logs'));
    }
}
