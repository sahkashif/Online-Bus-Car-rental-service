<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use Session;
use DateTime;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $car = Car::find($id);
        
        if(Session::has('booking')){
            $booking = Session::get('booking');

            

            $pd = new DateTime($booking->pickupdate);
            $dd = new DateTime($booking->dropoffdate);

            $days = $pd->diff($dd)->format('%d');
            $price = $days*$car->charge;
            if($price > 0){
                $booking->car_id = $id;
                $booking->carPrice = $price;
                $request->session()->put('booking',$booking);

                return view('car')->with([
                    'car' => $car,
                    'price' => $price
                ]);
            }else{
                return redirect('/')->with('error' , 'You have to rent car of atleast one day!');
            }
            
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
