<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Matching;
use App\Models\Admin\LotteryMatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BetLottery extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_amount',
        'user_id',
        'lottery_match_id',
    ];
//     public function matchings()
// {
//     return $this->belongsToMany(Matching::class, 'bet_lottery_matching', 'bet_lottery_id', 'matching_id')
//                 ->withPivot('digit_entry', 'sub_amount', 'prize_sent')
//                 ->withTimestamps();
// }

    // public function matchings()
    // {
    //     return $this->belongsToMany(Matching::class, 'bet_lottery_matching', 'bet_lottery_id', 'matching_id');
    // }

    public function user()
{
    return $this->belongsTo(User::class);
}
public function lotteryMatch()
{
    return $this->belongsTo(LotteryMatch::class);
}
}