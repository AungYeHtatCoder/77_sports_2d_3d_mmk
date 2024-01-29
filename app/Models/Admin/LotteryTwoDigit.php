<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryTwoDigit extends Model
{
    use HasFactory;
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}