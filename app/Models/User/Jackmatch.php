<?php

namespace App\Models\User;

use App\Models\Jackpot\Jackpot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jackmatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'match_name',
        'is_active'
    ];
    public function Jackpots()
{
    return $this->hasMany(Jackpot::class);
}

}