<?php

namespace App\Http\Middleware;
use Session;
use Closure;

class Booking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Session::has('booking')) {
            return redirect('search.result')->with('error', 'Please Select any seats/vechicle!!');
        }

        return $next($request);
    }
}
