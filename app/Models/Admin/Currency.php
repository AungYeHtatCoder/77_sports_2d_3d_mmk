<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'rate', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}