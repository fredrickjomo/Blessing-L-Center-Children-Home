<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    //
    protected $fillable= [
        'full_name',
        'gender',
        'year_of_birth',
        'vulnerability',
        'education_level',
        'photo',
    ];
    public function scopeSearchByKeyword($query,$keyword){
    if ($keyword!=''){
        $query->where(function ($query)use ($keyword){
           $query->where("full_name","LIKE","%$keyword%")
               ->orWhere("id","LIKE","%$keyword%");
        });
    }
    return $query;
    }
    public function sponsorship(){
        return $this->hasOne('App\Sponsorship');
    }
}
