<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charity_Events extends Model
{
    //
    protected $table='charity_events';
    protected $fillable=[
        'name','purpose','date_of_event','venue','photo',
    ];
}
