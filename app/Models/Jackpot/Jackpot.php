<?php

namespace App\Models\Jackpot;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\TwoDigit;
use App\Models\User\Jackmatch;
use App\Models\ThreedMatchTime;
use App\Models\Admin\LotteryMatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jackpot extends Model
{
    use HasFactory;
    protected $fillable = [
        'pay_amount',
        'total_amount',
        'user_id',
        'session',
        'jackmatch_id',
        'comission',
        'commission_amount',
    ];
    protected $dates = ['created_at', 'updated_at'];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lotteryMatch()
    {
        return $this->belongsTo(LotteryMatch::class, 'lottery_match_id');
    }
    public function threedMatchTime()
    {
        return $this->hasOne(ThreedMatchTime::class, 'id', 'lottery_match_id');
    }


    public function twoDigits() {
        return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit')->withPivot('sub_amount', 'prize_sent')->withTimestamps()->orderBy('created_at', 'desc');
    }

    public function JackpotDigits() {
        return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit')->withPivot('sub_amount', 'prize_sent')->withTimestamps();
    }

    public function twoDigitsCopy()
{
    return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit_copy')
        ->withPivot('prize_sent')
        ->withTimestamps();
}
// public function displayJackpotDigits($jackpotIds = [])
// {
//     // If no specific jackpot IDs are provided, fetch all jackpot IDs
//     if (empty($jackpotIds)) {
//         $jackpotIds = Jackpot::pluck('id');
//     }

//     // Define your date ranges using Carbon
//     $startDateFirstRange = Carbon::now()->startOfMonth();
//     $endDateFirstRange = Carbon::now()->startOfMonth()->addDays(16);
//     $startDateSecondRange = Carbon::now()->startOfMonth()->addDays(17);
//     $endDateSecondRange = Carbon::now()->endOfMonth();

//     return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit', 'jackpot_id', 'two_digit_id')
//         ->with('user') // Eager load the user relationship
//         ->select([
//             'two_digits.*', 
//             'jackpot_two_digit.jackpot_id AS pivot_jackpot_id', 
//             'jackpot_two_digit.two_digit_id AS pivot_two_digit_id', 
//             'jackpot_two_digit.sub_amount AS pivot_sub_amount', 
//             'jackpot_two_digit.prize_sent AS pivot_prize_sent', 
//             'jackpot_two_digit.created_at AS pivot_created_at', 
//             'jackpot_two_digit.updated_at AS pivot_updated_at'
//         ])
//         ->where(function ($query) use ($startDateFirstRange, $endDateFirstRange, $startDateSecondRange, $endDateSecondRange) {
//             $query->whereBetween('jackpot_two_digit.created_at', [$startDateFirstRange, $endDateFirstRange])
//                   ->orWhereBetween('jackpot_two_digit.created_at', [$startDateSecondRange, $endDateSecondRange]);
//         })
//         ->whereIn('jackpot_two_digit.jackpot_id', $jackpotIds)
//         ->orderBy('jackpot_two_digit.created_at', 'desc');
// }
   
    public function displayJackpotDigits($jackpotIds = [])
{
    // If no specific jackpot IDs are provided, fetch all jackpot IDs
    if (empty($jackpotIds)) {
        $jackpotIds = Jackpot::pluck('id');
    }

    // Define your date ranges using Carbon
    $startDateFirstRange = Carbon::now()->startOfMonth();
    $endDateFirstRange = Carbon::now()->startOfMonth()->addDays(16);
    $startDateSecondRange = Carbon::now()->startOfMonth()->addDays(17);
    $endDateSecondRange = Carbon::now()->endOfMonth();

    return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit', 'jackpot_id', 'two_digit_id')
        ->select([
            'two_digits.*', 
            'jackpot_two_digit.jackpot_id AS pivot_jackpot_id', 
            'jackpot_two_digit.two_digit_id AS pivot_two_digit_id', 
            'jackpot_two_digit.sub_amount AS pivot_sub_amount', 
            'jackpot_two_digit.prize_sent AS pivot_prize_sent', 
            'jackpot_two_digit.created_at AS pivot_created_at', 
            'jackpot_two_digit.updated_at AS pivot_updated_at'
        ])
        ->where(function ($query) use ($startDateFirstRange, $endDateFirstRange, $startDateSecondRange, $endDateSecondRange) {
            $query->whereBetween('jackpot_two_digit.created_at', [$startDateFirstRange, $endDateFirstRange])
                  ->orWhereBetween('jackpot_two_digit.created_at', [$startDateSecondRange, $endDateSecondRange]);
        })
        ->whereIn('jackpot_two_digit.jackpot_id', $jackpotIds)
        ->orderBy('jackpot_two_digit.created_at', 'desc');
}




    
    public function OnceMonthDisplayJackpotDigits()
    { 
        return $this->belongsToMany(TwoDigit::class, 'jackpot_two_digit', 'jackpot_id', 'two_digit_id')->withPivot('sub_amount', 'prize_sent', 'created_at')->orderBy('created_at', 'desc');
    }


    

}