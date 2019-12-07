<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bus;
use App\Seat;
use App\Stop;
use App\Booking;
use App\Order;
use App\PaymentDetail;
use Session;
use Auth;

class BookingController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

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
    public function create(Request $request)
    {
        //dd(Session::get('booking'));
        $booking = Session::get('booking');
        $fromStop = Stop::find($booking->fromId)->name;
        $toStop = Stop::find($booking->toId)->name; 
        $bus = Bus::find($booking->busId); 
        $numberOfSeats = $booking->numOfSeats;
        $totalPrice = $booking->totalPrice;
        $arrTime = $booking->arrTime;
        $depTime = $booking->depTime;
        $seats=$booking->seats;
        return view('booking_create')->with([
            'arrTime' => $arrTime,
            'depTime' => $depTime,
            'fromStop' => $fromStop,
            'toStop' => $toStop,
            'bus' => $bus,
            'seats' => $seats,
            'numberOfSeats' => $numberOfSeats,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Session::has('booking')){
            $booking =Session::get('booking');
            
            
            return view('payment')->with([
                'success' => 'Order is successfuly procceded',
                'order' => $order,
                ]);
            
            
        }
        return redirect()->back()->with('error', 'Seats are not being selected');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $order = Order::find($id);
        if($order->delete()){
            return redirect()->back()->with('success', 'Your Booking is Successfully Deleted!!');
        }
        return redirect()->back()->with('error', 'something went worng while deletion contact DEV ASAP..');
    }
}
