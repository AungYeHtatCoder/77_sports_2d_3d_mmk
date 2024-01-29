<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Lottery;
use App\Models\Jackpot\Jackpot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwoDigit extends Model
{
    use HasFactory;

    protected $fillable = [
        'two_digit',
    ];

    public function lotteries() {
        return $this->belongsToMany(Lottery::class, 'lottery_two_digit_pivot')->withPivot('sub_amount');
    }

     public function jackpots() {
        return $this->belongsToMany(Jackpot::class, 'jackpot_two_digit')->withPivot('sub_amount');
    }

   

    public function user()
    {
        return $this->belongsToThrough(User::class, Jackpot::class);
    }



}