@extends('layouts.app')
@section('content')

 <!-- Content
  ============================================= -->
  <div id="content">
    <div class="container">
      
      <div class="col-lg-12 text-center mt-5">
        <p class="text-success text-16 line-height-07"><i class="fas fa-check-circle"></i></p>
        <h2 class="text-8">Booking Successful</h2>
        
        <p class="lead">We are processing the same and you will be notified via SMS.</p>
      </div>
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
		  <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
            <div class="row">
              <div class="col-sm text-muted">Ticket ID</div>
              <div class="col-sm text-sm-right font-weight-600">{{ $order->id }}</div>
            </div>            
            <hr>
            @if ($order->car_id != 0)
            <div class="row">
              <div class="col-sm text-muted">Pick-Up Time</div>
              <div class="col-sm text-sm-right font-weight-600">{{ date("d M Y, D",strtotime($order->pick_up_time)) }}</div>
            </div> 
            <div class="row">
              <div class="col-sm text-muted">Drop-off Time</div>
              <div class="col-sm text-sm-right font-weight-600">{{ date("d M Y, D",strtotime($order->drop_off_time)) }}</div>
            </div>
            @else
            <div class="row">
              <div class="col-sm text-muted">Dep Time</div>
              <div class="col-sm text-sm-right font-weight-600">{{ date("d M Y, D",strtotime($order->dep_time)) }}</div>
            </div>
            @endif
            
            <hr>
            <div class="row">
              <div class="col-sm text-muted">Transaction Status</div>
              <div class="col-sm text-sm-right font-weight-600 text-success">Success</div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm text-muted">Customer Name</div>
              <div class="col-sm text-sm-right font-weight-600">{{ Auth::user()->name }}</div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm text-muted">Mobile No</div>
              <div class="col-sm text-sm-right font-weight-600">{{ Auth::user()->phone_number }}</div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm text-muted">Subject</div>
              <div class="col-sm text-sm-right font-weight-600">Ticket Booking</div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm text-muted">Payment Amount</div>
              <div class="col-sm text-sm-right text-6 font-weight-500">&#2547 {{ $order->price }}</div>
            </div>
        </div>
        
        <div class="text-center">
        <a href="{{ route('booking.export', $order->id) }}" class="btn-link text-muted mx-3 my-2 align-items-center d-inline-flex"><span class="text-5 mr-2"><i class="far fa-file-pdf"></i></span>Save as PDF</a>
        <p class="mt-4 mb-0"><a href="/" class="btn btn-primary">Search another ride</a></p>
        </div>
            
            
      </div>
    </div>
  </div><!-- Content end -->
<br><br><br>
@endsection