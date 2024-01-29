<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDlotteryCopy extends Model
{
    use HasFactory;
    protected $table = 'threed_lottery_pivot_copy';

    protected $fillable = [
        'threed_match_time_id',
        'threed_lottery_id',
        'digit_entry',
        'sub_amount',
        'prize_sent',
    ];

}