<?php 
// App\Services\LotteryService.php

namespace App\Services;

use App\Models\Admin\Lottery;
use Carbon\Carbon;

class TwoDLotteryService
{
    // public function getUserTwoDigits($userId, $session)
    // {
    //     $sessionTimes = $this->getSessionTimes($session);
    //     $twoDigits = Lottery::where('user_id', $userId)
    //                         ->with(['twoDigitsMorning' => function ($query) use ($sessionTimes) {
    //                             $query->wherePivotBetween('created_at', [$sessionTimes['start'], $sessionTimes['end']]);
    //                         }])
    //                         ->get()
    //                         ->pluck('twoDigitsMorning')
    //                         ->collapse()
    //                         ->map(function ($twoDigit) {
    //                             $twoDigit->created_at = $twoDigit->created_at->timezone('Asia/Yangon');
    //                             $twoDigit->updated_at = $twoDigit->updated_at->timezone('Asia/Yangon');
    //                             $twoDigit->pivot->created_at = $twoDigit->pivot->created_at->timezone('Asia/Yangon');
    //                             return $twoDigit;
    //                         });

    //     $totalAmount = $twoDigits->sum('pivot.sub_amount');

    //     return [
    //         'two_digits' => $twoDigits,
    //         'total_amount' => $totalAmount
    //     ];
    // }
    public function getUserTwoDigits($userId, $session)
    {
        $sessionTimes = $this->getSessionTimes($session);
        $twoDigits = Lottery::where('user_id', $userId)
                            ->with(['twoDigitsForSession' => function ($query) use ($sessionTimes) {
                                $query->wherePivotBetween('created_at', [$sessionTimes['start'], $sessionTimes['end']]);
                            }])
                            ->get()
                            ->pluck('twoDigitsForSession')
                            ->collapse()
                            ->map(function ($twoDigit) {
                                // The accessors in the TwoDigit model will automatically convert these
                                $twoDigit->created_at; // Already in 'Asia/Yangon' timezone
                                $twoDigit->updated_at; // Already in 'Asia/Yangon' timezone

                                // Manually convert pivot timestamps if they are not covered by the model's accessors
                                $twoDigit->pivot->created_at = Carbon::parse($twoDigit->pivot->created_at)->timezone('Asia/Yangon');
                                $twoDigit->pivot->updated_at = Carbon::parse($twoDigit->pivot->updated_at)->timezone('Asia/Yangon');

                                return $twoDigit;
                            });

        $totalAmount = $twoDigits->sum('pivot.sub_amount');

        return [
            'two_digits' => $twoDigits,
            'total_amount' => $totalAmount
        ];
    }

    public static function getUserMorningTwoDigits($userId)
{
    $morningTwoDigits = Lottery::where('user_id', $userId)
                            ->with('twoDigitsMorning')
                            ->get()
                            ->pluck('twoDigitsMorning')
                            ->collapse() // Collapse the collection to a single dimension
                            ->map(function ($twoDigit) {
                                $twoDigit->created_at = $twoDigit->created_at->timezone('Asia/Yangon');
                                $twoDigit->updated_at = $twoDigit->updated_at->timezone('Asia/Yangon');
                                $twoDigit->pivot->created_at = $twoDigit->pivot->created_at->timezone('Asia/Yangon');
                                return $twoDigit;
                            });

    // Sum the sub_amount from the pivot table
    $totalAmount = $morningTwoDigits->sum(function ($twoDigit) {
        return $twoDigit->pivot->sub_amount;
    });

    return [
        'two_digits' => $morningTwoDigits,
        'total_amount' => $totalAmount
    ];
}


    protected function getSessionTimes($session)
    {
        $startOfDay = Carbon::now()->startOfDay();
        switch ($session) {
            case 'morning':
                return [
                    'start' => $startOfDay->copy()->setTime(5, 30),
                    'end' => $startOfDay->copy()->setTime(12, 15)
                ];
            case 'evening':
                // Define evening session times here
                return [
                    'start' => $startOfDay->copy()->setTime(12, 30),
                    'end' => $startOfDay->copy()->setTime(19, 15)
                ];
                break;
            // Add more cases for different sessions as needed
        }
    }
}