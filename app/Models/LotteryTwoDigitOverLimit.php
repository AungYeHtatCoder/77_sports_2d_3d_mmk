<?php

namespace App\Models;

use App\Models\LotteryOverLimitCopy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LotteryTwoDigitOverLimit extends Model
{
    use HasFactory;
    protected $table = 'lottery_over_limit';
    protected $fillable = ['lottery_id', 'two_digit_id', 'sub_amount', 'prize_sent'];
    protected static function booted()
    {
        static::created(function ($pivot) {
            LotteryOverLimitCopy::create($pivot->toArray());
        });
    }
}