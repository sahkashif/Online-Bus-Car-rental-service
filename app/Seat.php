<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function bus(){
        $this->belongsTo('App\Bus');
    }

    public function order(){
        $this->belongsTo('App\Order');
    }
}
