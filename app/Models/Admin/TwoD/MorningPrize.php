<?php

namespace App\Models\Admin\TwoD;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MorningPrize extends Model
{
    use HasFactory;
    protected $table = 'morning_prizes';
    protected $fillable = ['user_id','user_name', 'phone', 'bet_digit', 'sub_amount', 'prize_amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}