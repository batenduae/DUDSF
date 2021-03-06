<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'adminType', 'adminStatus',
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    protected $casts =[
        'email_verified_at' => 'datetime'
    ];
}
