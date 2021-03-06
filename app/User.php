<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [ 'role_id', 'first_name', 'last_name', 'email', 'password', 'status' , 'contact_no' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
