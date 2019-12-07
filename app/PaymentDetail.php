<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    public function user(){
        $this->belongsTo('App\User');
    }

    public function order(){
        $this->belongsTo('App\Order');
    }
}
