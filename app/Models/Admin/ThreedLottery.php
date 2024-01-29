<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\LotteryMatch;
use App\Models\Admin\ThreedMatchTime;
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
        return $this->belongsToMany(ThreedLotteryEntry::class, 'threed_lottery_pivot_copy');
    }
    public function threedMatchTimes()
{
    return $this->belongsToMany(ThreedMatchTime::class, 'lottery_match_pivot', 'threed_lottery_id', 'threed_match_time_id');
}

}