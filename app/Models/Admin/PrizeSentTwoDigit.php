<?php

namespace App\Models\Admin;

use App\Models\Admin\Lottery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrizeSentTwoDigit extends Model
{
    use HasFactory;
    protected $table = 'two_digits';

    protected $fillable = [
        'two_digit',
    ];

    public function lotteries() {
        return $this->belongsToMany(Lottery::class, 'lottery_two_digit_copy')->withPivot('sub_amount');
    }
}