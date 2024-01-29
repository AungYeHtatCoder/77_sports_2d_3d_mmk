<?php

namespace App\Models\Jackpot;

use App\Models\User;
use App\Jobs\JackpotWinnerUpdate;
use App\Jobs\CheckForJackpotWinner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JackpotWinner extends Model
{
    use HasFactory;
    protected $fillable = [
        'prize_no',
        
    ];
     public function users()
    {
        return $this->belongsToMany(User::class);
    }
    // Inside your TwodWiner model
protected static function booted()
{
    static::created(function ($jackpotWiner) {
        if ($jackpotWiner) {
            CheckForJackpotWinner::dispatch($jackpotWiner);
            JackpotWinnerUpdate::dispatch($jackpotWiner);
        } 
    });
}

}