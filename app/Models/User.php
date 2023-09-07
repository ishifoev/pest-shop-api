<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        'uuid',
        'first_name',
        'last_name',
        'is_admin',
        'email',
        'email_verified_at',
        'password',
        'avatar',
        'address',
        'phone_number',
        'is_marketing',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     // Generate a UUID for the user
     public static function boot()
     {
         parent::boot();
 
         static::creating(function ($user) {
             $user->uuid = Uuid::uuid4()->toString();
         });
     }
}
