@extends('layouts.app')
@section('content')
    <!-- Page Header
============================================= -->
<section class="page-header page-header-text-light bg-secondary">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-8">
            <h1>Bus - List Page</h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
            <li><a href="/">Home</a></li>
            <li class="active">Bus List Page</li>
            </ul>
        </div>
        </div>
    </div>
</section><!-- Page Header end -->
     
<!-- Content
============================================= -->
@if (count($results) == 0)
<div class="card text-center">
    <div class="card-header">
      NO BUSES FOUND!!
    </div>
    <div class="card-body">
      <h5 class="card-title">We are sorry</h5>
      <p class="card-text">Please search after a while.Thank you for being with us.</p>
      <a href="/" class="btn btn-primary">SEARCH AGAIN</a>
    </div>
    
  </div>
</div>     
@else
<div id="content">
<section class="container">
    <div class="row">
        <div class="col-md-12 mt-4 mt-md-0">
            <div class="bg-light shadow-md rounded py-4">
                <div class="mx-3 mb-3 text-center">
                        <h2 class="text-5">{{ $from->name }}, {{ $from->district->name }} <small class="mx-2">to</small>{{ $to->name }}, {{ $to->district->name }}</h2>
                </div>
                <div class="text-1 bg-light-3 border border-right-0 border-left-0 py-2 px-3">
                    <div class="row">
                        <div class="col col-sm-3"><span class="d-none d-sm-block">Operators</span></div>
                        <div class="col col-sm-3 text-center">Departure</div>
                        <div class="col col-sm-3 text-center">Arrival</div>
                        <div class="col col-sm-3 text-center d-none d-sm-block">Price</div>
                    </div>
                </div>
                <div class="bus-list">
                        @foreach ($results as $result)
                       
                        @if ($result['dep_time']->dep_time && $result['dep_time']->dep_time < $result['arr_time']->arr_time)
                        <div class="bus-item">
                            <div class="row align-items-sm-center flex-row py-4 px-3">
                            <div class="col col-sm-3"> <span class="text-3 text-dark operator-name">{{ $result['bus']->name }}</span> <span class="text-1 text-muted d-block">AC Sleeper</span> </div>
                            <div class="col col-sm-3 text-center time-info">
                                {{ $result['dep_time']->dep_time }}
                                <span class="text-2 text-dark"></span>
                                <small class="text-muted d-block">{{ $from->name }}</small> 
                            </div>
                          
                            <div class="col col-sm-3 text-center time-info">
                                {{ $result['arr_time']->arr_time }} 
                                <span class="text-2 text-dark"></span>
                                <small class="text-muted d-block">{{ $to->name }}</small>
                            </div>
                          <div class="col-12 col-sm-3 align-self-center text-right text-sm-center mt-2 mt-sm-0">
                            <div class="d-inline-block d-sm-block text-dark text-5 price mb-sm-1">&#2547 {{ $result['bus']->fair }}</div>
                            <a href="#" class="btn btn-sm btn-outline-primary shadow-none" data-toggle="modal" data-target="#select-busseats-{{ $result['bus']->id }}"><i class="fas fa-ellipsis-h d-none d-sm-block d-lg-none" data-toggle="tooltip" title="Select Seats"></i> <span class="d-block d-sm-none d-lg-block">Select Seats</span></a> </div>
                        </div>
                        @include('inc.seat_details')
                        @endif
                        
                        

                      @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
</div><!-- Content end -->

        <!-- Back to Top
============================================= -->
<a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a>
@endif
<br><br>
@endsection
  
  
  


