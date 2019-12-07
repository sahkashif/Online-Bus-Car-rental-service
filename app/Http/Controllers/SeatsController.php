<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bus;
use App\Seat;
use App\Booking;
use Session;

class SeatsController extends Controller
{
    /**
     * stores booking data into session.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookingSession(Request $request)
    {
        $price=Bus::find($request->id)->fair;
        //dd($request->all());
        $seats=json_decode($request->seats);
        $n=count($seats);

        if(Session::has('booking')){
            $booking = Session::get('booking');
        }
        else{
            $booking =  new Booking;
        }
        
        $booking->busId=$request->id;
        $booking->seats=$seats;
        $booking->fromId=$request->fromId;
        $booking->toId=$request->toId;
        $booking->depTime=$request->depTime;
        $booking->arrTime=$request->arrTime;
        $booking->numOfSeats= $n;
        $booking->totalPrice= $n*$price;

        $request->session()->put('booking',$booking);
        
        return $seats;
      
    }
    /**
     * Display a listing of the specific categorised resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $seats = Seat::where('bus_id', $id)->get();
        $t= $seats->where('status', 'unavailable')->pluck('seat_code')->toArray();
        dd($t);
        return [$seats,$t];
    }

    /**
     * Display a selected listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function occupied($id)
    {
        $seats = Seat::where('bus_id', $id)->get();
        $t= $seats->where('status', 'unavailable');
        $bus = Bus::find($id);
        //dd($t);
        return ['bookings' => $t, 'bus' => $bus] ;
    }

}
