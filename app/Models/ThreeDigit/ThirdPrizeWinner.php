<?php

namespace App\Models\ThreeDigit;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThirdPrizeWinner extends Model
{
    use HasFactory;
    protected $table = 'third_prize_winners';
    protected $fillable = ['user_id','user_name', 'phone', 'bet_digit', 'sub_amount', 'prize_amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}