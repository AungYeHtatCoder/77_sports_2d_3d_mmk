<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseTwoDigit extends Model
{
    use HasFactory;
    protected $table = 'close_two_digits';
    protected $fillable = [
        'digit',
    ];
}