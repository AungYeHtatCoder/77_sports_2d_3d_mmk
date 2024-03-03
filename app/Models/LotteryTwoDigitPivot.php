<?php

namespace App\Models;

use App\Models\LotteryTwoDigitCopy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LotteryTwoDigitPivot extends Model
{
    use HasFactory;
    public function __construct(array $attributes = [])
{
    parent::__construct($attributes);
    self::boot();  // Ensure the model is booted
}

    protected $table = 'lottery_two_digit_pivot';
    protected $fillable = ['lottery_id', 'two_digit_id', 'bet_digit', 'sub_amount', 'prize_sent'];
    // This will automatically boot with the model's events
    protected static function booted()
    {
        static::created(function ($pivot) {
            LotteryTwoDigitCopy::create($pivot->toArray());
        });
    }
}