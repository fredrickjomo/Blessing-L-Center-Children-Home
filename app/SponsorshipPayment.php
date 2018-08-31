<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorshipPayment extends Model
{
    //
    protected $fillable=[
        'year','month','sponsor_id','child_id','plan_subscribed','pay','amount_lack','receipt','transaction_id'
    ];
}
