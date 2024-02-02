<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\LotteryMatch;
use App\Models\Admin\PrizeSentTwoDigit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lottery extends Model
{
    use HasFactory;
    protected $fillable = [
        'pay_amount',
        'total_amount',
        'user_id',
        'session',
        'lottery_match_id'
    ];
    protected $dates = ['created_at', 'updated_at'];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lotteryMatch()
    {
        return $this->belongsTo(LotteryMatch::class, 'lottery_match_id');
    }

    public function twoDigits() {
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot')->withPivot('sub_amount', 'prize_sent')->withTimestamps();
    }
    // two digit early morning
    public function twoDigitsEarlyMorning()
    {
        // $morningStart = Carbon::now()->startOfDay()->addHours(6);
        // $morningEnd = Carbon::now()->startOfDay()->addHours(10);
        // return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
        //             ->wherePivotBetween('created_at', [$morningStart, $morningEnd]);
        $morningStart = Carbon::now()->subDay()->setTime(17, 0);
        $morningEnd = Carbon::now()->startOfDay()->setTime(9, 30);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$morningStart, $morningEnd]);
    }

    public function twoDigitsMorning()
    {
        $morningStart = Carbon::now()->startOfDay()->setTime(5, 30);
        $morningEnd = Carbon::now()->startOfDay()->setTime(12, 15);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$morningStart, $morningEnd]);
    }

    // two digit early evening
    public function twoDigitsEarlyEvening()
    {
        $eveningStart = Carbon::now()->startOfDay()->addHours(12);
        $eveningEnd = Carbon::now()->startOfDay()->setTime(14, 15);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$eveningStart, $eveningEnd]);
    }

    public function twoDigitsEvening()
    {
        $eveningStart = Carbon::now()->startOfDay()->addHours(12);
        $eveningEnd = Carbon::now()->startOfDay()->addHours(20);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$eveningStart, $eveningEnd]);
    }

    // once month two digit history
    public function twoDigitsOnceMonth()
    {
        $onceMonthStart = Carbon::now()->startOfMonth();
        $onceMonthEnd = Carbon::now()->endOfMonth();
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$onceMonthStart, $onceMonthEnd]);
    }

    public function Admin2DMorningHistory($twoDid = [], $timestamp = '2022-01-01 00:00:00', $timezone = 'Asia/Yangon')
    {
        if (empty($twoDid)) {
            $twoDid = Lottery::pluck('id');
        }

        // Create a DateTime object with the original timestamp
        $dateTime = new \DateTime($timestamp, new \DateTimeZone('UTC')); // Assuming the original timestamp is in UTC

        // Set the timezone to 'Asia/Yangon'
        $dateTime->setTimezone(new \DateTimeZone($timezone));

        // Get the time at 5 AM and 12:30 PM in the new timezone
        $timeAt5AM = clone $dateTime;
        $timeAt5AM->setTime(5, 0);
        $timeAt1230PM = clone $dateTime;
        $timeAt1230PM->setTime(12, 30);

        // Get the current time
        $currentTime = new \DateTime('now', new \DateTimeZone($timezone));

        // If the current time is past 12:30 PM, return an empty collection or a specific message
        if ($currentTime > $timeAt1230PM) {
            return collect(); // or return 'The specific time is over';
        }

        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')
            ->select([
                'two_digits.*', 
                'lottery_two_digit_pivot.lottery_id AS pivot_lottery_id', 
                'lottery_two_digit_pivot.two_digit_id AS pivot_two_digit_id', 
                'lottery_two_digit_pivot.sub_amount AS pivot_sub_amount', 
                'lottery_two_digit_pivot.prize_sent AS pivot_prize_sent', 
                'lottery_two_digit_pivot.created_at AS pivot_created_at', 
                'lottery_two_digit_pivot.updated_at AS pivot_updated_at'
            ])
            ->where(function ($query) use ($timeAt5AM, $timeAt1230PM) {
                $query->whereBetween('lottery_two_digit_pivot.created_at', [$timeAt5AM->format('Y-m-d H:i:s'), $timeAt1230PM->format('Y-m-d H:i:s')]);
            })
            ->whereIn('lottery_two_digit_pivot.lottery_id', $twoDid)
            ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
    }
//     public function Admin2DMorningHistory($twoDid = [])
// {
//     if (empty($twoDid)) {
//         $twoDid = Lottery::pluck('id');
//     }
//     $timeAt5AM = Carbon::now()->setTime(5, 0);
//     $timeAt1230PM = Carbon::now()->setTime(12, 30);
//     return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')
//         ->select([
//             'two_digits.*', 
//             'lottery_two_digit_pivot.lottery_id AS pivot_lottery_id', 
//             'lottery_two_digit_pivot.two_digit_id AS pivot_two_digit_id', 
//             'lottery_two_digit_pivot.sub_amount AS pivot_sub_amount', 
//             'lottery_two_digit_pivot.prize_sent AS pivot_prize_sent', 
//             'lottery_two_digit_pivot.created_at AS pivot_created_at', 
//             'lottery_two_digit_pivot.updated_at AS pivot_updated_at'
//         ])
//         ->where(function ($query) use ($timeAt5AM, $timeAt1230PM) {
//             $query->whereBetween('lottery_two_digit_pivot.created_at', [$timeAt5AM, $timeAt1230PM]);
//         })
//         ->whereIn('lottery_two_digit_pivot.lottery_id', $twoDid)
//         ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
// }

    public function Admin2dDailyEveningHistory($twoDid = [], $timestamp = '2022-01-01 00:00:00', $timezone = 'Asia/Yangon')
    {
        if (empty($twoDid)) {
            $twoDid = Lottery::pluck('id');
        }

        // Create a DateTime object with the original timestamp
        $dateTime = new \DateTime($timestamp, new \DateTimeZone('UTC')); // Assuming the original timestamp is in UTC

        // Set the timezone to 'Asia/Yangon'
        $dateTime->setTimezone(new \DateTimeZone($timezone));

        // Get the time at 12 PM and 5:30 PM in the new timezone
        $timeAt12PM = clone $dateTime;
        $timeAt12PM->setTime(12, 0);
        $timeAt530PM = clone $dateTime;
        $timeAt530PM->setTime(17, 30);

        // Get the current time
        $currentTime = new \DateTime('now', new \DateTimeZone($timezone));

        // If the current time is past 5:30 PM, return an empty collection or a specific message
        if ($currentTime > $timeAt530PM) {
            return collect(); // or return 'The specific time is over';
        }

        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')
            ->select([
                'two_digits.*', 
                'lottery_two_digit_pivot.lottery_id AS pivot_lottery_id', 
                'lottery_two_digit_pivot.two_digit_id AS pivot_two_digit_id', 
                'lottery_two_digit_pivot.sub_amount AS pivot_sub_amount', 
                'lottery_two_digit_pivot.prize_sent AS pivot_prize_sent', 
                'lottery_two_digit_pivot.created_at AS pivot_created_at', 
                'lottery_two_digit_pivot.updated_at AS pivot_updated_at'
            ])
            ->where(function ($query) use ($timeAt12PM, $timeAt530PM) {
                $query->whereBetween('lottery_two_digit_pivot.created_at', [$timeAt12PM->format('Y-m-d H:i:s'), $timeAt530PM->format('Y-m-d H:i:s')]);
            })
            ->whereIn('lottery_two_digit_pivot.lottery_id', $twoDid)
            ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
    }
    
    // public function Admin2dDailyEveningHistory($twoDid = [], $timestamp = '2024-01-01 00:00:00', $timezone = 'Asia/Yangon')
    // {
    //     if (empty($twoDid)) {
    //         $twoDid = Lottery::pluck('id');
    //     }

    //     // Create a DateTime object with the original timestamp
    //     $dateTime = new \DateTime($timestamp, new \DateTimeZone('UTC')); // Assuming the original timestamp is in UTC

    //     // Set the timezone to 'Asia/Yangon'
    //     $dateTime->setTimezone(new \DateTimeZone($timezone));

    //     // Get the time at 12 PM and 5:30 PM in the new timezone
    //     $timeAt12PM = clone $dateTime;
    //     $timeAt12PM->setTime(12, 0);
    //     $timeAt530PM = clone $dateTime;
    //     $timeAt530PM->setTime(17, 30);

    //     return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')
    //         ->select([
    //             'two_digits.*', 
    //             'lottery_two_digit_pivot.lottery_id AS pivot_lottery_id', 
    //             'lottery_two_digit_pivot.two_digit_id AS pivot_two_digit_id', 
    //             'lottery_two_digit_pivot.sub_amount AS pivot_sub_amount', 
    //             'lottery_two_digit_pivot.prize_sent AS pivot_prize_sent', 
    //             'lottery_two_digit_pivot.created_at AS pivot_created_at', 
    //             'lottery_two_digit_pivot.updated_at AS pivot_updated_at'
    //         ])
    //         ->where(function ($query) use ($timeAt12PM, $timeAt530PM) {
    //             $query->whereBetween('lottery_two_digit_pivot.created_at', [$timeAt12PM->format('Y-m-d H:i:s'), $timeAt530PM->format('Y-m-d H:i:s')]);
    //         })
    //         ->whereIn('lottery_two_digit_pivot.lottery_id', $twoDid)
    //         ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
    // }


    // public function Admin2dDailyEveningHistory($twoDid = [], $timezone = 'Asia/Yangon')
    // {
    //     if (empty($twoDid)) {
    //         $twoDid = Lottery::pluck('id');
    //     }
    //     $timeAt12PM = Carbon::now($timezone)->startOfDay()->setTime(12, 0);
    //     $timeAt530PM = Carbon::now($timezone)->startOfDay()->setTime(17, 30);
    //     return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')
    //         ->select([
    //             'two_digits.*', 
    //             'lottery_two_digit_pivot.lottery_id AS pivot_lottery_id', 
    //             'lottery_two_digit_pivot.two_digit_id AS pivot_two_digit_id', 
    //             'lottery_two_digit_pivot.sub_amount AS pivot_sub_amount', 
    //             'lottery_two_digit_pivot.prize_sent AS pivot_prize_sent', 
    //             'lottery_two_digit_pivot.created_at AS pivot_created_at', 
    //             'lottery_two_digit_pivot.updated_at AS pivot_updated_at'
    //         ])
    //         ->where(function ($query) use ($timeAt12PM, $timeAt530PM) {
    //             $query->whereBetween('lottery_two_digit_pivot.created_at', [$timeAt12PM, $timeAt530PM]);
    //         })
    //         ->whereIn('lottery_two_digit_pivot.lottery_id', $twoDid)
    //         ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
    // }

    

// public function Admin2DEveningHistory($twoDid = [])
// {
//      $timezone = 'Asia/Yangon'; // Set your desired timezone

//     if (empty($twoDid)) {
//         $twoDid = Lottery::pluck('id');
//     }
    
//     $timeAt12PM = Carbon::now($timezone)->setTime(12, 0);
//     $timeAt430PM = Carbon::now($timezone)->setTime(17, 30);
//     return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')
//         ->select([
//             'two_digits.*', 
//             'lottery_two_digit_pivot.lottery_id AS pivot_lottery_id', 
//             'lottery_two_digit_pivot.two_digit_id AS pivot_two_digit_id', 
//             'lottery_two_digit_pivot.sub_amount AS pivot_sub_amount', 
//             'lottery_two_digit_pivot.prize_sent AS pivot_prize_sent', 
//             'lottery_two_digit_pivot.created_at AS pivot_created_at', 
//             'lottery_two_digit_pivot.updated_at AS pivot_updated_at'
//         ])
//         ->where(function ($query) use ($timeAt12PM, $timeAt430PM) {
//             $query->whereBetween('lottery_two_digit_pivot.created_at', [$timeAt12PM, $timeAt430PM]);
//         })
//         ->whereIn('lottery_two_digit_pivot.lottery_id', $twoDid)
//         ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
// }

// public function Admin2DMorningHistory($twoDid = [])
// {
//     if (empty($twoDid)) {
//         $twoDid = Lottery::pluck('id');
//     }
//     $timeAt5AM = Carbon::now()->setTime(5, 0);
//     $timeAt1230PM = Carbon::now()->setTime(12, 30);
//     return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')
//         ->join('users', 'lottery_two_digit_pivot.user_id', '=', 'users.id')
//         ->select([
//             'two_digits.*', 
//             'lottery_two_digit_pivot.lottery_id AS pivot_lottery_id', 
//             'lottery_two_digit_pivot.two_digit_id AS pivot_two_digit_id', 
//             'lottery_two_digit_pivot.sub_amount AS pivot_sub_amount', 
//             'lottery_two_digit_pivot.prize_sent AS pivot_prize_sent', 
//             'lottery_two_digit_pivot.created_at AS pivot_created_at', 
//             'lottery_two_digit_pivot.updated_at AS pivot_updated_at',
//             'users.name',
//             'users.phone'
//         ])
//         ->where(function ($query) use ($timeAt5AM, $timeAt1230PM) {
//             $query->whereBetween('lottery_two_digit_pivot.created_at', [$timeAt5AM, $timeAt1230PM]);
//         })
//         ->whereIn('lottery_two_digit_pivot.lottery_id', $twoDid)
//         ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
// }
/* 
if you want to get user name and phone number from user table then you can use join method to join user table with lottery_two_digit_pivot table and select user name and phone number from user table. change table like this
public function up(): void
    {
        Schema::create('lottery_two_digit_pivot', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('lottery_id');
        $table->unsignedBigInteger('two_digit_id');
        // sub amount
        $table->integer('sub_amount')->default(0);
        //prize_sent 
        $table->boolean('prize_sent')->default(false);
        $table->foreign('lottery_id')->references('id')->on('lotteries')->onDelete('cascade');
        $table->foreign('two_digit_id')->references('id')->on('two_digits')->onDelete('cascade');
        $table->timestamps();
        });
    }
    
*/
    
}