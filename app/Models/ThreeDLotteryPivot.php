<?php

namespace App\Models;

use App\Models\ThreeDlotteryCopy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ThreeDLotteryPivot extends Model
{
    use HasFactory;


     protected $table = 'lottery_match_pivot';

    // This will automatically boot with the model's events
    protected static function booted()
    {
        static::created(function ($pivot) {
            ThreeDlotteryCopy::create($pivot->toArray());
        });
    }
    }