<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $table = 'roles';
    protected $date = ['created_at', 'updated_at'];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);

    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);

    }
}