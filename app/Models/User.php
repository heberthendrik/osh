<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password','roles','id_rs','image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
