<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'external_id', 
        'external_auth',
        'name',
        'given_name',
        'family_name',
        'email',
        'avatar',
        'email_verified',
        'password',
        'login_count',
        'workspace_domain',
        'locale',
        'last_login',
        'login_count'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified' => 'boolean',
            'last_login' => 'datetime',
        ];
    }

    /**
    * Method to encrypt the password when its needed
    */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    /**
    * Set the last login date
    */
    public function incrementLoginCount()
    {
        $this->increment('login_count');
        $this->update(['last_login' => now('UTC')->toIso8601String()]);
    }

    /**
    * Relations
    */
    public function logins()
    {
        return $this->hasMany(Login::class, 'user_id');
    }
}