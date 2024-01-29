<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetNotificationTwoDPlayUserController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('admin.noti.two_d_noti_index', compact('notifications'));
    }
    public function playTwoDmarkNotification(Request $request)
{
    auth()->user()
        ->unreadNotifications
        ->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

    return response()->noContent();
}
}