<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    protected $fillable=[
        'user_id','name','braintree_id','braintree_plan','quantity'
    ];
}
