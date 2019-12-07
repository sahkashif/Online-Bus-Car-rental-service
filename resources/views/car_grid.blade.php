@extends('layouts.app')
@section('content')
<div id="content">
    <!-- Page Header
============================================= -->
<section class="page-header page-header-text-light bg-secondary">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-8">
            <h1>Car - List</h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                <li><a href="/">Home</a></li>
                <li class="active">Car List</li>
            </ul>
        </div>
        </div>
    </div>
</section>
@include('inc.message')
    <!-- Page Header end -->
<section class="container">
<!-- List Item
============================================= -->
@if (count($cars)==0)
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

    <div class="car-list">
        <div class="card-body">
            <h5 class="card-title">Search Result</h5>
            <blockquote class="blockquote">
                <p class="card-text">Showing results of available cars from <abbr title="Pick-up Date">{{ date("d M Y, D",strtotime($pickupdate)) }}</abbr> to <abbr title="Drop-off Date">{{ date("d M Y, D",strtotime($dropoffdate)) }}</abbr>. </p>
            </blockquote>
        </div>
        <div class="row">
        @foreach ($cars as $car)
        
        <div class="col-md-6 ">
                <div class="card shadow-sm border-0 mb-4">
                  <a class="px-3" href="#"><img class="img-fluid rounded align-top" src={{ asset('images/brands/cars/'.$car->id.'.png') }} alt="cars"></a>
                  <div class="card-body">
                    <h4 class="d-flex align-items-center"><a href="#" class="text-dark text-5 mr-2">{{ $car->name }}</a> <span class="alert alert-info rounded-pill px-2 py-1 line-height-1 font-weight-400 text-2 mb-0">{{ $car->type }}</span></h4>
                    <p class="car-features d-flex align-items-center mb-2 text-4">
                              <span data-toggle="tooltip" data-original-title="5 Adult Passenger"><i class="fas fa-user"></i> <small>{{ $car->no_seat }}</small></span>
                              <span data-toggle="tooltip" data-original-title="2 Large Bag"><i class="fas fa-suitcase-rolling"></i> <small>2</small></span>
                              <span data-toggle="tooltip" data-original-title="1 Small Bag"><i class="fas fa-suitcase"></i> <small>1</small></span>
                              <span data-toggle="tooltip" data-original-title="Automatic transmission"><i class="fas fa-cog"></i> <small>Auto</small></span>
                              <span data-toggle="tooltip" data-original-title="Drive unlimited distance with this car at no extra cost"><i class="fas fa-tachometer-alt"></i> <small>Mileage</small></span>
                              <span data-toggle="tooltip" data-original-title="Air Conditioning Available"><i class="fas fa-snowflake"></i> <small>A/C</small></span>
                          </p>                
                    <div class="row text-1 mb-3">
                      <div class="col-lg-6" data-toggle="tooltip" data-original-title="Free cancellation up to 72 hours prior to pick up">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span>Free Cancellation
                      </div>
                      <div class="col-lg-6" data-toggle="tooltip" data-original-title="Instantly confirmed upon booking">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span>Instantly Confirmed
                      </div>
                      <div class="col-lg-6" data-toggle="tooltip" data-original-title="In the unlikely event you find a better price on the same brand, we'll beat it. See 'Price Promise' on our About Us page">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span>Price Guarantee
                      </div>
                      <div class="col-lg-6" data-toggle="tooltip" data-original-title="Rate includes Third Party Liability Cover">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span>Third Party Liability
                      </div>
                    </div>
                    
                  </div>
                  <div class="card-footer bg-transparent d-flex align-items-center">
                    <div class="text-dark text-4 font-weight-500 mr-2 mr-lg-3">
                        &#2547 {{ $car->charge*$days }}<br>
                       
                        <input type="hidden" value="{{ $car->charge*$days }}" name="price">
                    </div>
                    <a href="{{ route('car.show',$car->id) }}" class="btn btn-sm btn-primary ml-auto"  id="book">Book Now</a> 
                  </div>
                </div>
              </div>
        
        @endforeach
        

        
            </div><!-- List Item end -->
          
           
          
          </div>
        </div>
    </section>
  </div><!-- Content end -->
      
@endif
@endsection