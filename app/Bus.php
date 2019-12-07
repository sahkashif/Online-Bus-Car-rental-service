<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public function route(){
        return $this->belongsTo('App\Route');
    }
    public function stops(){
        return $this->belongsToMany('App\Stop')
                    ->using('App\bus_stop')
                    ->withPivot([
                        'id',
                        'arr_time',
                        'dep_time'
                    ]);
    }
    
    public function seats(){
        $this->hasMany('App\Seat');
    }

    public function schedules(){
        $this->hasMany('App\Schedule');
    }
}
