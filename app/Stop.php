<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    public function district(){
        return $this->belongsTo('App\District');
    }
    public function routes(){
        return $this->belongsToMany('App\Route');
    }
    public function buses(){
        return $this->belongsToMany('App\Bus')->using('App\bus_stop')
        ->withPivot([
            'id',
            'arr_time',
            'dep_time'
        ]);
    }

    public function schedules(){
        $this->hasMany('App\Schedule');
    }

    public function name(){
        return $this->name;
    }
   
    
}
