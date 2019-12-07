@extends('layouts.app')
@section('content')

<!-- Page Header
============================================= -->
<section class="page-header page-header-text-light bg-secondary">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
            <h1>Car - Details Page</h1>
            </div>
            <div class="col-md-4">
            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                <li><a href="/">Home</a></li>
                <li><a href="#">Cars</a></li>
                <li class="active">Car - Details Page</li>
            </ul>
            </div>
        </div>
    </div>
</section>
<!-- Page Header end --> 
      
<!-- Content
  ============================================= -->
  <div id="content">
        <div class="container">
          <div class="row">
              <!-- Middle Panel
            ============================================= -->
            <div class="col-lg-8">
             
             <!-- Car Details
             ============================================= -->
             <div class="bg-light shadow-md rounded p-3 p-sm-4 mb-4">
                  <h2 class="d-flex align-items-center text-7">{{ $car->name }} <span class="alert alert-info rounded-pill px-3 py-1 ml-2 line-height-1 font-weight-400 text-3 mb-0">Economy</span></h2>
                <div class="row">
                      <div class="col-md-5">
                          <img class="img-fluid align-top" src={{ asset('images/brands/cars/'.$car->id.'.png') }} alt="cars">
                      </div>
                      <div class="col-md-7 mt-3 mt-md-0">
                          <p class="car-features d-flex align-items-center mb-0 text-4">
                              <span data-toggle="tooltip" data-original-title="{{ $car->no_seat }} Adult Passenger"><i class="fas fa-user"></i> <small>{{ $car->no_seat }}</small></span>
                              <span data-toggle="tooltip" data-original-title="2 Large Bag"><i class="fas fa-suitcase-rolling"></i> <small>2</small></span>
                              <span data-toggle="tooltip" data-original-title="1 Small Bag"><i class="fas fa-suitcase"></i> <small>1</small></span>
                              <span data-toggle="tooltip" data-original-title="Drive unlimited distance with this car at no extra cost"><i class="fas fa-tachometer-alt"></i> <small>Mileage</small></span>
                              <span data-toggle="tooltip" data-original-title="Air Conditioning Available"><i class="fas fa-snowflake"></i> <small>A/C</small></span>
                          </p>
                          <p class="car-features d-flex align-items-center text-4">
                              <span data-toggle="tooltip" data-original-title="Vehicle to be returned with the same amount of fuel as start of the trip to avoid refuelling charges"><i class="fas fa-gas-pump"></i> <small>Full to Full</small></span>
                              <span data-toggle="tooltip" data-original-title="Automatic transmission"><i class="fas fa-cog"></i> <small>Auto Transmission</small></span>
                          </p>
                          <h4 class="text-3">Included in the price:</h4>
                          <div class="row mb-3">
                      <div class="col-sm-6" data-toggle="tooltip" data-original-title="Free cancellation up to 72 hours prior to pick up">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span> Free Cancellation
                      </div>
                      <div class="col-sm-6" data-toggle="tooltip" data-original-title="Instantly confirmed upon booking">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span> Instantly Confirmed
                      </div>
                      <div class="col-sm-6" data-toggle="tooltip" data-original-title="In the unlikely event you find a better price on the same brand, we'll beat it. See 'Price Promise' on our About Us page">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span> Price Guarantee
                      </div>
                      <div class="col-sm-6" data-toggle="tooltip" data-original-title="Rate includes Third Party Liability Cover">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span> Third Party Liability
                      </div>
                      <div class="col-sm-6" data-toggle="tooltip" data-original-title="If the car is stolen, all you’ll pay is the theft excess – not the full cost of the car.">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span> Theft Protection
                      </div>
                      <div class="col-sm-6" data-toggle="tooltip" data-original-title="If the car’s bodywork gets damaged, the most you’ll pay is the damage excess.">
                          <span class="text-success mr-1"><i class="fas fa-check"></i></span> Damage Waiver
                      </div>
                    </div>                
                          
                      </div>
                    </div>
             </div><!-- Car Details end -->
             
             <!-- Alert
             ============================================= -->
             <div class="alert alert-info shadow-md">
             <i class="fas fa-check-circle"></i>
             <strong class="font-weight-500">Instant Confirmation:</strong> This vehicle is available now. You will get your confirmation immediately.
             </div><!-- Alert end -->

             
             <!-- Important Information
             ============================================= -->
             <div class="bg-light shadow-md rounded p-3 p-sm-4 mb-4">
             <h2 class="text-6 mb-3">Important Information <a class="text-2 float-right" href="#">See More in T&amp;C</a></h2>
             <div class="row">
             <div class="col-md-4">
             <ul id="list-example" class="nav nav-tabs flex-md-column mb-4 mb-md-0">
               <li class="nav-item"><a class="nav-link" href="#list-item-1">Excess</a></li>
              <li class="nav-item"><a class="nav-link active" href="#list-item-2">Mileage Allowance</a></li>
              <li class="nav-item"><a class="nav-link" href="#list-item-3">Age Requirements</a></li>
              <li class="nav-item"><a class="nav-link" href="#list-item-4">Need at Pick-up</a></li>
              <li class="nav-item"><a class="nav-link" href="#list-item-5">Payment Methods</a></li>
            </ul>
            </div>
            <div class="col-md-8">
            <div data-spy="scroll" data-target="#list-example" data-offset="0" class="position-relative overflow-auto" style="height:330px;">
              <h5 id="list-item-1">1. Excess</h5>
              <p>Iisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet. Mediocrem qualisque in has. Enim utroque perfecto id mei, ad eam tritani labores facilisis, ullum sensibus no cum. Eius eleifend in quo. At mei alia iriure propriae.</p>
              <h5 id="list-item-2">2. Mileage Allowance</h5>
              <p>Iisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet. Mediocrem qualisque in has.</p>
              <h5 id="list-item-3">3. Age Requirements</h5>
              <p>Iisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure.</p>
              <ul>
                <li>Quot quidam persequeris vim</li>
                <li>Mutat tacimates id sit.</li>
                <li>Enim utroque perfecto id mei</li>
                <li>At mei alia iriure propriae.</li>
              </ul>
              <h5 id="list-item-4">4. What You'll Need at Pick-up</h5>
              <p>Iisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet. Mediocrem qualisque in has. Enim utroque perfecto id mei, ad eam tritani labores facilisis, ullum sensibus no cum. Eius eleifend in quo. At mei alia iriure propriae.</p>
              <h5 id="list-item-5">5. Payment Methods</h5>
              <p>Iisque persius interesset his et, in quot quidam persequeris vim, ad mea essent possim iriure. Mutat tacimates id sit. Ridens mediocritatem ius an, eu nec magna imperdiet.</p>
              <ul>
                <li>Quot quidam persequeris vim</li>
                <li>Mutat tacimates id sit.</li>
                <li>Enim utroque perfecto id mei</li>
                <li>At mei alia iriure propriae.</li>
              </ul>
            </div>
            </div>
            </div>
            </div><!-- Important Information end -->
              
              
              
            </div><!-- Middle Panel End --> 
    
            <!-- Side Panel
            ============================================= -->
            <aside class="col-lg-4 mt-4 mt-lg-0">
            
            <!-- Pick-up and Drop-off details
            ============================================= -->
            <div class="bg-light shadow-md rounded p-3 mb-4">
              <div class="position-relative pl-4">
              <div class="location-brief-line">
                    <em class="location-brief-pickup"></em>
                    <em class="location-brief-dropoff"></em>
                </div>
              <h3 class="text-4 mb-2">Pick-up</h3>
              <ul class="list-unstyled">
              <li class="mb-1">{{ date("d M Y, h:i A",strtotime(Session::get('booking')->pickupdate)) }}</li>
              
              </ul>
              </div>
              <div class="pl-4">
              <h3 class="text-4 mb-2">Drop-off</h3>
              <ul class="list-unstyled">
              <li class="mb-1">{{ date("d M Y, h:i A",strtotime(Session::get('booking')->dropoffdate)) }}</li>
              
              </ul>
              </div>
              <div class="text-center"><a href="/"><i class="fas fa-edit"></i> Modify Search</a></div>
            </div><!-- Pick-up and Drop-off details End -->
              
              <!-- Price Summary
              ============================================= -->
              <div class="bg-light shadow-md rounded p-3 sticky-top">
              <h3 class="text-5 mb-3">Price Summary</h3>
                <ul class="list-unstyled">
                    <li class="mb-2">Car rental fee <span class="float-right text-5 font-weight-500 text-dark">&#2547 {{ $price }}</span><br>
                      <small class="text-muted line-height-07">Taxes include Airport tax (pick up in airport), Customer facilities, Tourism tax</small></li>
                    
                  </ul>
                  <div class="text-dark text-4 font-weight-500 py-4 border-top"> Total Amount<span class="float-right text-9">&#2547 {{ $price }}</span></div>              
                  
                  <a class="btn btn-primary btn-block" href="{{ route('checkout.index') }}">Book Now</a>
                <div class="custom-control custom-checkbox text-1 mt-3">
                  <input type="checkbox" id="terms" name="termsConditions" class="custom-control-input">
                  <label class="custom-control-label d-block" for="terms">I understand & agree with the <a href="#">Terms &amp; Conditions</a>.</label>
                  </div>
                <p class="text-danger text-center mt-2 mb-0"><i class="far fa-clock"></i> Last Booked - 6 hours ago</p>
              </div><!-- Price Summary End -->
              
            </aside><!-- Side Panel End --> 
          </div>
        </div>
      </div>
      <!-- Content end --> 
             
@endsection