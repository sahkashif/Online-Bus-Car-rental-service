<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;


class Booking
{
    public $busId;
    public $toId = 0;
    public $fromId=0;
    public $depTime;
    public $arrTime;
    public $totalPrice=0;
    public $numOfSeats=0;
    public $seats = [];
    //public $isCar = 0;
    public $car_id;
    public $pickupdate;
    public $dropoffdate;
    public $carPrice = 0;
}
