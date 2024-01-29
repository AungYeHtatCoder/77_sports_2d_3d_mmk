<?php

namespace App\Models\Admin;

use App\Models\Admin\BetLottery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matching extends Model
{
    use HasFactory;
    protected $fillable = [
        'open_time',
        'match_time'
        
    ];
    public function betLotteries()
{
    return $this->belongsToMany(BetLottery::class, 'bet_lottery_matching', 'matching_id', 'bet_lottery_id')
                ->withPivot('digit_entry', 'sub_amount', 'prize_sent')
                ->withTimestamps();
}

    // public function betLotteries()
    // {
    //     return $this->belongsToMany(BetLottery::class, 'bet_lottery_matching', 'matching_id', 'bet_lottery_id');
    // }
}