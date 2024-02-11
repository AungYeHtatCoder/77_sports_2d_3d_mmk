<?php 
// App\Services\LotteryService.php

namespace App\Services;

use App\Models\Admin\Lottery;
use Carbon\Carbon;

class TwoDLotteryService
{
    // Retrieve two digits for a user based on session ('morning' or 'evening')
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
           // Convert main model timestamps
           if ($twoDigit->created_at && $twoDigit->created_at instanceof \DateTime) {
            $twoDigit->created_at = Carbon::parse($twoDigit->created_at)->timezone('Asia/Yangon')->toDateTimeString();
           }
           if ($twoDigit->updated_at && $twoDigit->updated_at instanceof \DateTime) {
            $twoDigit->updated_at = Carbon::parse($twoDigit->updated_at)->timezone('Asia/Yangon')->toDateTimeString();
           }
           
           // Convert pivot timestamps
           if ($twoDigit->pivot->created_at && $twoDigit->pivot->created_at instanceof \DateTime) {
            $twoDigit->pivot->created_at = Carbon::parse($twoDigit->pivot->created_at)->timezone('Asia/Yangon')->toDateTimeString();
           }
           if ($twoDigit->pivot->updated_at && $twoDigit->pivot->updated_at instanceof \DateTime) {
            $twoDigit->pivot->updated_at = Carbon::parse($twoDigit->pivot->updated_at)->timezone('Asia/Yangon')->toDateTimeString();
           }
           
           return $twoDigit;
          });

     $totalAmount = $twoDigits->sum('pivot.sub_amount');

     return [
      'two_digits' => $twoDigits,
      'total_amount' => $totalAmount
     ];
    }

    // Define session times based on session name
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
                return [
                    'start' => $startOfDay->copy()->setTime(12, 30),
                    'end' => $startOfDay->copy()->setTime(19, 15)
                ];
        }
    }
}