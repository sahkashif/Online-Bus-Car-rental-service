<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\District;
use Session;
use App\Stop;
use App\Route;

class PagesController extends Controller
{
    public function index(){
        $districts=District::all();
        $stops=Stop::all();
        return view('index')->with([
            'districts' => $districts,
            'stops' => $stops
        ]);
    }
}
