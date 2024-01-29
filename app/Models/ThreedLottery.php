<?php

namespace App\Models;

use App\Models\User;
use App\Models\Admin\LotteryMatch;
use App\Models\ThreedMatchTime;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ThreedLotteryEntry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

class ThreedLottery extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_amount',
        'user_id',
        'lottery_match_id',
    ];

    /**
     * Get the user that owns the ThreedLottery.
     */
    protected $dates = ['created_at', 'updated_at'];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lotteryMatch()
    {
        return $this->belongsTo(LotteryMatch::class, 'lottery_match_id');
    }

    public function entries()
    {
        return $this->belongsToMany(ThreedLotteryEntry::class);
    }
    public function threedMatchTimes()
{
    return $this->belongsToMany(ThreedMatchTime::class, 'threed_lottery_pivot_copy', 'threed_lottery_id', 'threed_match_time_id');
}

// to copy to ThreedLotteryEntry model with booted method
}