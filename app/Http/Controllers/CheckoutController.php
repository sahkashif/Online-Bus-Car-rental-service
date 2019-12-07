<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ConfirmationTicket;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Auth;
use App\Order;
use App\Seat;
use App\PaymentDetail;
use Session;
use PDF;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Auth::user()->id."_".Auth::user()->name);
        if(Session::has('booking')){
            $order = Session::get('booking');
            return view('checkout')->with([
                'order'=> $order
                ]);
        }
        
       return redirect()->back()->with('error', 'No seat selected');
    }


    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stripe_order(Request $request)
    {
        try {
            $booking = Session::get('booking');
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey('sk_test_4W0LJdwoXjtmlLnNkAnTHIfI00LLPJtsKy');

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $request->input('stripeToken');
            $customer= Auth::user()->id."_".Auth::user()->name;
            if($booking->car_id != 0){
                $description = "car_id: ".$booking->car_id.", pick-up date: ".$booking->pickupdate.", drop off date: ".$booking->dropoffdate;

                $charge = \Stripe\Charge::create([
                    'amount' => Session::get('booking')->carPrice * 1000,
                    'currency' => 'bdt',
                    'description' => $description,
                    'source' => $token,
                ]);
            }else{
                $description = "Bus_id: ".$booking->busId.", from: ".$booking->fromId.", to: ".$booking->toId;

                $charge = \Stripe\Charge::create([
                    'amount' => Session::get('booking')->totalPrice * 1000,
                    'currency' => 'bdt',
                    'description' => $description,
                    'source' => $token,
                ]);
            }
           
         
            //dd($charge);
            
            if($charge->status == 'succeeded'){
                //storing order
                $transection = new PaymentDetail;
                $order = new Order;
                if($booking->car_id != 0){
                    $order->user_id = Auth::user()->id;
                    $order->car_id = $booking->car_id;
                    $order->pick_up_date = $booking->pickupdate;
                    $order->drop_off_date = $booking->dropoffdate;
                    $order->price =$booking->carPrice;
                    $order->is_car = 1;
                    $order->save();

                    //payment details
                    $transection->order_id=$order->id;
                    $transection->user_id=Auth::user()->id;
                    $transection->transection_id=$charge->id;
                    $transection->payment_method='stripe';
                    $transection->payment_amount=$order->price;
                    $transection->payment_status=true;
                    $transection->save();


                    $phn_num = Auth::user()->phone_number;
                    //Notification::route('nexmo', '8801756702510')->notify(new ConfirmationTicket($order));
                    //Notification::route('mail', 'sahkashif@hotmail.com')->notify(new ConfirmationTicket($order));
                    $user= Auth::user();
                    $user->notify(new ConfirmationTicket($order));
                                
                    $request->session()->forget('booking');
                    
                    return view('success')->with(['order' => $order]);

                }else{
                    $order->user_id = Auth::user()->id;
                    $order->bus_id = $booking->busId;
                    $order->start_stop_id = $booking->fromId;
                    $order->dep_time=$booking->depTime;
                    $order->end_stop_id = $booking->toId;
                    $order->arr_time = $booking->arrTime;
                    $order->price = $booking->totalPrice;
                    $order->save();
                    $seats = Seat::whereIn('seat_code', $booking->seats)->get();
                    //storing seats status
                    foreach($seats as $seat){
                        $seat->status = 'unavailable';
                        $seat->order_id = $order->id;
                        $seat->save();
                    }
                    //payment details
                    $transection->order_id=$order->id;
                    $transection->user_id=Auth::user()->id;
                    $transection->transection_id=$charge->id;
                    $transection->payment_method='stripe';
                    $transection->payment_amount=$order->price;
                    $transection->payment_status=true;
                    $transection->save();


                    $phn_num = Auth::user()->phone_number;
                    //Notification::route('nexmo', '8801756702510')->notify(new ConfirmationTicket($order));
                    //Notification::route('mail', 'sahkashif@hotmail.com')->notify(new ConfirmationTicket($order));
                    $user= Auth::user();
                    $user->notify(new ConfirmationTicket($order));
                                
                    $request->session()->forget('booking');
                    
                    return view('success')->with(['order' => $order]);
                }
                return redirect()->back()->with('error', 'something went wronh while transection!!');
                
            }
            
            
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    /**
     * exports invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export($id)
    {
        $order = Order::find($id)->toArray();
        $data['order']=$order;
        //dd($order);
        $pdf = PDF::loadView('invoice', ['order' => $order] );
        //dd($pdf);
        return $pdf->download('invoice.pdf');
        //return view('invoice')->with(['order' => $order]);
    }

   
}
