<?php

namespace App\Models;


use App\Models\Admin\Matching;
use App\Models\BetLotteryMatching;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BetLotteryMatchingCopy extends Model
{
    use HasFactory;
     protected $table = 'bet_lottery_matching_copy';
    protected $fillable = ['matching_id', 'bet_lottery_id', 'digit_entry', 'sub_amount', 'prize_sent'];

    protected static function booted()
    {
        static::created(function ($betLotteryMatchingCopy) {
            BetLotteryMatching::create([
                'matching_id' => $betLotteryMatchingCopy->matching_id,
                'bet_lottery_id' => $betLotteryMatchingCopy->bet_lottery_id,
                'digit_entry' => $betLotteryMatchingCopy->digit_entry,
                'sub_amount' => $betLotteryMatchingCopy->sub_amount,
                'prize_sent' => $betLotteryMatchingCopy->prize_sent,
                'created_at' => $betLotteryMatchingCopy->created_at,
                'updated_at' => $betLotteryMatchingCopy->updated_at
            ]);
        });
    }

}