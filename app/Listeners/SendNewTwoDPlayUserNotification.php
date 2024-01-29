<?php

namespace App\Listeners;

use Log;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TwoDigitPlayedNotification;

class SendNewTwoDPlayUserNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    public function handle($event)
    {
       // \Log::info('Listener received the event');
        $admins = User::whereHas('roles', function ($query) {
                $query->where('id', 1);
            })->get();
            //dd($admins);
           // \Log::info('Number of admins fetched: ' . $admins->count());

        Notification::send($admins, new TwoDigitPlayedNotification($event->user));
    }
}