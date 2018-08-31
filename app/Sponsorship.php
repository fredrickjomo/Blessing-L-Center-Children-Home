<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    //
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'nationality',
        'child_id',
        'period',
        'phone_number',
        'payment_method'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function children(){
        return $this->belongsTo('App\Children');
    }

}
