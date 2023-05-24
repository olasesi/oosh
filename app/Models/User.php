<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'active',
        'firstname',
        'lastname',
        'email',
        'date_of_birth',
        'gender',
        'password',
        'remember_token',
        'profile_picture',
        'username',
        'location',
        'country',
        'website',
        'bio',
        'peerID',
        'cover_photo',
       'profile_verify',
       'page_verify',
        'voicepeerID',
        'verification_code'
        'occupation',
        'zipcode',
        'state',
        'city',
        'address',
        'hobby',
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
    ];
}
