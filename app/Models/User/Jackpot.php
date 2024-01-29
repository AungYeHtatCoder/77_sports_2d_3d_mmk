<?php

namespace App\Models\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\TwoDigit;
use App\Models\User\Jackmatch;
use App\Models\ThreedMatchTime;
use App\Models\Admin\LotteryMatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jackpot extends Model
{
    use HasFactory;
    protected $fillable = [
        'pay_amount',
        'total_amount',
        'user_id',
        'jackmatch_id',
        'comission',
        'commission_amount',
    ];
    protected $dates = ['created_at', 'updated_at'];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function JackMatch()
    // {
    //     return $this->belongsTo(Jackmatch::class, 'jackmatch_id');
    // }
    public function lotteryMatch()
    {
        return $this->belongsTo(LotteryMatch::class, 'lottery_match_id');
    }
    public function threedMatchTime()
    {
        return $this->hasOne(ThreedMatchTime::class, 'id', 'lottery_match_id');
    }


    public function twoDigits() {
        return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit')->withPivot('sub_amount', 'prize_sent')->withTimestamps()->orderBy('created_at', 'desc');
    }


     public function DisplayJackpotDigitsOver()
    { 
        return $this->belongsToMany(TwoDigit::class, 'jackpot_over', 'jackpot_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at');
    }

    public function JackpotDigitWinner()
    {
        $morningStart = Carbon::now()->startOfDay()->addHours(10);
        $morningEnd = Carbon::now()->startOfDay()->addHours(24);
        return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit_copy', 'jackpot_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$morningStart, $morningEnd]);
    }

}