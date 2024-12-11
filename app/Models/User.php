<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable // Ab Authenticatable ko extend karain
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected $primaryKey = 'user_id';

    protected $casts = [
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        // Assuming there's a 'role' column in your 'users' table
        // which defines if the user is admin. Adjust this based on your DB schema.
        return $this->role === 'admin';
    }
}
