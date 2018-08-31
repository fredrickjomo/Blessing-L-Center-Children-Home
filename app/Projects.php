<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    //
    protected $fillable=[
        'name','purpose','duration','start_date','end_date','photo'
    ];
}
