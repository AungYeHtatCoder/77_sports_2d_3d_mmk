<?php

namespace App\Models\Admin;

use App\Models\Admin\Lottery;
use App\Models\Admin\BetLottery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LotteryMatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'match_name',
        'is_active'
    ];
    public function lotteries()
{
    return $this->hasMany(Lottery::class);
}
public function betLotteries()
{
    return $this->hasMany(BetLottery::class);
}

    public function threedMatchTime()
    {
        return $this->hasOne(ThreedMatchTime::class, 'id', 'lottery_match_id');
    }

}