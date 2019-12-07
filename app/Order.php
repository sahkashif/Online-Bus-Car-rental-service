<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seat;
use App\Stop;
use App\PaymentDetail;

class Order extends Model
{
    public function user(){
       return $this->belongsTo('App\User');
    }

    public function transection(){
        return PaymentDetail::where('order_id',$this->id)->pluck('payment_status')->first();
    }

    public function price(){
        return PaymentDetail::where('order_id',$this->id)->pluck('payment_amount')->first();
    }

    public function status(){
        return $this->hasOne('App\PaymentDetails');
    }

    public function seats(){
        $seats =Seat::where('order_id', $this->id)->get();
        return $seats;
    }
    public function no_seats(){
        $seats =Seat::where('order_id', $this->id)->count();
        return $seats;
    }

    public function start_stop_name(){
        return Stop::find($this->start_stop_id)->name;
    }

    public function end_stop_name(){
        return Stop::find($this->end_stop_id)->name;
    }
}
