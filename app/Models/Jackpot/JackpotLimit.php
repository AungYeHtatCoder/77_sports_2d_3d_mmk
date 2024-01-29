<?php

namespace App\Models\Jackpot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JackpotLimit extends Model
{
    use HasFactory;
     protected $fillable = [
        'jack_limit',
    ];
}