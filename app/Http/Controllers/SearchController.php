<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stop;
use App\Route;
use App\Bus;
use App\Schedule;
use App\bus_stop;
use App\Car;
use App\Booking;
use Session;
use DateTime;


class SearchController extends Controller
{
    /**
     * Display a searched listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'datetime' => 'required',
            'from' => 'required',
            'to' => 'required',
            
        ]);
        
        $to = Stop::find($request->input('to'));
        $from = Stop::find($request->input('from'));
        $arr_time = date('Y-m-d H:i:s', strtotime($request->input('datetime')));
        $to_id = Stop::find($request->input('to'))->id;
        $from_id = Stop::find($request->input('from'))->id;
        
        
        //find the route
        $routes = Route::whereHas('stops', function($q) use ($request){
            $q->whereHas('buses', function($q2) use ($request) {
                $q2->where('arr_time','>=', date('Y-m-d H:i:s', strtotime($request->input('datetime'))));
            })->where('stop_id',$request->input('from'));
        })->whereHas('stops', function($w) use ($request){
            $w->where('stop_id',$request->input('to'));
        })->get();
        
        //find buses
        $buses = Bus::whereHas('stops', function($q) use ($request){
            $q->where('stop_id',$request->input('from'))->whereDate('arr_time','>=', $request->input('datetime'));
        })->whereHas('stops', function($w) use ($request){
            $w->where('stop_id',$request->input('to'))->whereDate('arr_time','>', $request->input('datetime'));
        })->whereIn('route_id', $routes)->get();

        
        
        //check schedules
        $scheduleFrom = bus_stop::where('stop_id', $from->id)->whereIn('bus_id', $buses->pluck('id'))->get()->toArray();
        $scheduleTo = bus_stop::where('stop_id', $to->id)->whereIn('bus_id', $buses->pluck('id'))->get()->toArray();
        
        $result = [];
        $results = [];


        //puts results in an array
        for($i=0;$i<count($scheduleFrom);$i++){
            if($scheduleFrom[$i]['dep_time'] < $scheduleTo[$i]['arr_time']){
                $result = ['bus' => Bus::find($scheduleFrom[$i]['bus_id']), 'dep_time' => bus_stop::find($scheduleFrom[$i]['id']), 'arr_time' => bus_stop::find($scheduleTo[$i]['id']) ];
                array_push($results,$result);
            }
        }
            
     
        //dd($results);
        return view('test_search')->with([
            'buses' => $buses,
            'to' => $to,
            'from' => $from,
            'scheduleFrom'=> $scheduleFrom,
            'scheduleTo' => $scheduleTo,
            'results' => $results
            ]);
    }
    /**
     * Display a searched listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function carSearch(Request $request){
        
        if(Session::has('booking')){
            $booking = Session::get('booking');
        }
        else{
            $booking =  new Booking;
        }
        if($request->input('seats')){
            $cars = Car::where('no_seat','>=', $request->input('seats'))->where('stop_id', $request->input('loc'))->where('is_available', 1)->get();
        }
        else{
            $cars = Car::where('is_available', 1)->get();
        }
        
        $pickupdate = $request->input('pickupdate');
        $dropoffdate = $request->input('dropoffdate');
        
        $booking->pickupdate = $pickupdate;
        $booking->dropoffdate = $dropoffdate;
        $request->session()->put('booking',$booking);
        
        $pd = new DateTime($pickupdate);
        $dd = new DateTime($dropoffdate);
        $days = $pd->diff($dd)->format('%d');
        //dd($pd);
        return view('car_grid')->with([
            'days' => $days,
            'pickupdate' => $pickupdate,
            'dropoffdate' => $dropoffdate,
            'cars' => $cars
        ]);
    }
    
    public function stops($dId){
        $route = Bus::find($dId)->route()->first()->id;
        $stops = Route::find($route)->stops()->get();
        //dd($stops);
        return ['stops' => $stops];
    }
}
