<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\TwoDigit;
use App\Models\Admin\LotteryMatch;
use Illuminate\Support\Facades\DB;
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

    // In your Lottery model

    public function twoDigitsForSession()
    {
        $morningStart = Carbon::now()->startOfDay()->setTime(5, 30);
        $morningEnd = Carbon::now()->startOfDay()->setTime(12, 15);
        return $this->belongsToMany(TwoDigit::class, 'lottery_two_digit_pivot')
                    ->withPivot('sub_amount', 'prize_sent', 'created_at')
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

    public function dailyMorningHistoryForAdmin($startTime, $endTime) {
        // Define your date ranges using Carbon
        $startDate = Carbon::createFromFormat('H:i', $startTime);
        $endDate = Carbon::createFromFormat('H:i', $endTime);

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
            ->whereBetween('lottery_two_digit_pivot.created_at', [$startDate, $endDate])
            ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
    }


    public function dailyEveningHistoryForAdmin($startTime, $endTime) {
        // Define your date ranges using Carbon
         $startDate = $startTime->format('H:i');
         $endDate = $endTime->format('H:i');
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
            ->whereBetween('lottery_two_digit_pivot.created_at', [$startDate, $endDate])
            ->orderBy('lottery_two_digit_pivot.created_at', 'desc');
    }
    
}