<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Stop;
use App\Bus;
use App\Route;

class SchedulerController extends Controller
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
        
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::all();
        $routes = Route::all();
        $buses = Bus::all();
        return view('admin.scheduler')->with([
            'districts' => $districts,
            'routes' => $routes,
            'buses' => $buses
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
        //
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
    public function update(Request $request)
    {
       
        $request->validate([
            'bus' => 'required',
            'from' => 'required',
            'fromdeptime' => 'required',
            'fromarrtime' => 'required',
            'to' => 'required',
            'todeptime' => 'required',
            'toarrtime' => 'required',
        ]);
        if($request->input('from') == $request->input('to')){
            return redirect()->back()->with('error', 'Wrong Input');
        }
        $from = Stop::find($request->input('from'));
        $fromarrtime = $request->input('fromarrtime');
        $fromdeptime = $request->input('fromdeptime');
        $to = Stop::find($request->input('to'));
        $toarrtime = $request->input('toarrtime');
        $todeptime = $request->input('todeptime');
        $bus = Bus::find($request->input('bus'));

        $bus->stops()->attach($from, [
            'arr_time' => $fromarrtime,
            'dep_time' => $fromdeptime
        ]);
        $bus->stops()->attach($to, [
            'arr_time' => $toarrtime,
            'dep_time' => $todeptime
        ]);

        return redirect()->back()->with('success','success');
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
