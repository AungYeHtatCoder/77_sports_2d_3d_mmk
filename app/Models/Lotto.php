<?php

namespace App\Models;

use Carbon\Carbon;
// use App\Models\Admin\ThreedDigit;
use App\Models\User;
use App\Models\Admin\LotteryMatch;
use App\Models\Admin\ThreedMatchTime;
use App\Models\ThreeDigit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lotto extends Model
{
    use HasFactory;
     protected $fillable = [
        'total_amount',
        'user_id',
        //'session',
        'lottery_match_id',
        'comission',
        'commission_amount',
        'status',
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
    public function threedMatchTime()
    {
        // Assuming you have a model called ThreedMatchTime and there is a 'lottery_match_id' foreign key in it.
        return $this->hasOne(ThreedMatchTime::class, 'id', 'lottery_match_id');
    }

     public function threedDigits() {
        return $this->belongsToMany(ThreeDigit::class, 'lotto_three_digit_copy')->withPivot('sub_amount', 'prize_sent')->withTimestamps();
    }
    public function Prizes() {
        return $this->belongsToMany(ThreeDigit::class, 'lotto_three_digit_pivot')->withPivot('sub_amount', 'prize_sent')->withTimestamps();
    }

    public function DisplayThreeDigits()
    { 
        return $this->belongsToMany(ThreeDigit::class, 'lotto_three_digit_copy', 'lotto_id', 'three_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at');
    }

    public function DisplayThreeDigitsOver()
    { 
        return $this->belongsToMany(ThreeDigit::class, 'lotto_three_digit_over', 'lotto_id', 'three_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at');
    }

    public function threedDigitWinner()
    {
        $morningStart = Carbon::now()->startOfDay()->addHours(10);
        $morningEnd = Carbon::now()->startOfDay()->addHours(24);
        return $this->belongsToMany(ThreeDigit::class, 'lotto_three_digit_copy', 'lotto_id', 'three_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')
                    ->wherePivotBetween('created_at', [$morningStart, $morningEnd]);
    }
}