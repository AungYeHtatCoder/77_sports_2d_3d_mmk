<?php

namespace App\Models\Admin;

use App\Models\Admin\ThreedLottery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThreedMatchTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'open_time',
        'match_time',
    ];
    public function threedLotteries()
{
    return $this->belongsToMany(ThreedLottery::class, 'lottery_match_pivot', 'threed_match_time_id', 'threed_lottery_id');
}

}