<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff_members extends Model
{
    //
    protected $fillable=[
        'first_name','last_name','middle_name','position','photo','gender','year_of_birth',
    ];
}
