<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function bus(){
        $this->belongsTo('App\Bus');
    }

    public function stop(){
        $this->belongsTo('App\Stop');
    }
}
