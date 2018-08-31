<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;


class User extends Authenticatable
{
    use Notifiable;
    use Billable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'nationality',
        'email',
        'password',
        'photo',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function countries(){
        return $this->hasMany('App\Countries');
    }
    public function verifyUser(){
        return $this->hasOne('App\Verifyuser');
    }
    public function sponsorships(){
        return $this->hasOne('App\Sponsorship');
    }
}
