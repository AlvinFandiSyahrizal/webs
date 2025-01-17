<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'logins'; 

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if ($user->password) {
                $user->password = bcrypt($user->password); 
            }
        });
    }
}
