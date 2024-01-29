<?php

namespace App\Models;

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
        'lottery_match_id',
        'comission',
        'commission_amount',
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
        $morningStart = Carbon::now()->startOfDay()->addHours(6);
        $morningEnd = Carbon::now()->startOfDay()->addHours(10);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$morningStart, $morningEnd]);
    }

    public function twoDigitsMorning()
    {
        $morningStart = Carbon::now()->startOfDay()->addHours(10);
        $morningEnd = Carbon::now()->startOfDay()->addHours(12);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$morningStart, $morningEnd]);
    }

    // two digit early evening
    public function twoDigitsEarlyEvening()
    {
        $eveningStart = Carbon::now()->startOfDay()->addHours(12);
        $eveningEnd = Carbon::now()->startOfDay()->addHours(14);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$eveningStart, $eveningEnd]);
    }

    public function twoDigitsEvening()
    {
        $eveningStart = Carbon::now()->startOfDay()->addHours(14);
        $eveningEnd = Carbon::now()->startOfDay()->addHours(24);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$eveningStart, $eveningEnd]);
    }

    

    // public function twoDigitsMorning()
    // {
    //     $morningStart = Carbon::now()->startOfDay()->addHours(6);
    //     $morningEnd = Carbon::now()->startOfDay()->addHours(12);
    //     return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
    //                 ->wherePivotBetween('created_at', [$morningStart, $morningEnd]);
    // }

    // public function twoDigitsEvening()
    // {
    //     $eveningStart = Carbon::now()->startOfDay()->addHours(12);
    //     $eveningEnd = Carbon::now()->startOfDay()->addHours(24);
    //     return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot', 'lottery_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
    //                 ->wherePivotBetween('created_at', [$eveningStart, $eveningEnd]);
    // }
}