<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'login_time',
        'ip_address',
    ];

    /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */

    protected function casts(): array
    {
        return [
            'login_time' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}