<?php

namespace App\Models;

use App\Models\ThreedLottery;
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
    return $this->belongsToMany(ThreedLottery::class, 'threed_lottery_pivot_copy', 'threed_match_time_id', 'threed_lottery_id');
}

}