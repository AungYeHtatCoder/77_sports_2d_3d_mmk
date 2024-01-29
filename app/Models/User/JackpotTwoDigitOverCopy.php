<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JackpotTwoDigitOverCopy extends Model
{
    use HasFactory;
    protected $table = 'jackpot_over_copy';
    protected $fillable = ['jackpot_id', 'two_digit_id', 'sub_amount', 'prize_sent'];
}