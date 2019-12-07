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
                <li class="active">Bus Booking</li>
            </ul>
        </div>
        </div>
    </div>
</section>
<!-- Message
  ============================================= -->
  @include('inc.message')
  <!-- Message end --> 
<!-- Content
  ============================================= -->
<div id="content">
    <section class="container">
        <div class="row">
        <div class="col-lg-8">
            <div class="bg-light shadow-md rounded p-3 p-sm-4 confirm-details">
            <h2 class="text-6 mb-3">Confirm Bus Details</h2>
            <div class="card">
                <div class="card-header">
                <div class="row align-items-center trip-title">
                    <div class="col-5 col-sm-auto text-center text-sm-left">
                    <h5 class="m-0 trip-place">{{ $fromStop }}</h5>
                    </div>
                    <div class="col-2 col-sm-auto text-8 text-black-50 text-center trip-arrow">➝</div>
                    <div class="col-5 col-sm-auto text-center text-sm-left">
                    <h5 class="m-0 trip-place">{{ $toStop }}</h5>
                    </div>
                    <div class="col-12 mt-1 d-block d-md-none"></div>
                    <div class="col-6 col-sm col-md-auto text-3 date">{{ date("d M Y, D",strtotime($depTime)) }}</div>
                    <div class="col-6 col-sm col-md-auto text-right order-sm-1"><a class="text-1" data-toggle="modal" data-target="#fare-rules"  href="#">Fare Rules</a></div>
                    <div class="col col-md-auto text-center ml-auto order-sm-0"><span class="badge badge-success py-1 px-2 font-weight-normal text-1">Refundable</span></div>
                </div>
                </div>
                <div class="card-body">
                <div class="row align-items-sm-center flex-row">
                    <div class="col-12 col-sm-3 mb-3 mb-sm-0"> <span class="text-3 text-dark operator-name">{{ $bus->name }}</span> <span class="text-muted d-block">AC Sleeper</span> </div>
                    <div class="col col-sm-3 text-center time-info"> <span class="text-5 text-dark">{{ date("h:i A",strtotime($depTime)) }}</span> <small class="text-muted d-block">{{ $fromStop }}</small> </div>
                    <div class="col col-sm-3 text-center time-info"> <span class="text-5 text-dark">{{ date("h:i A",strtotime($arrTime)) }}</span> <small class="text-muted d-block">{{ $toStop }}</small> </div>
                    <div class="col-12 mt-3 text-dark">Seat No(s):
                        @foreach ($seats as $seats)
                        <span class="bg-success text-light rounded px-2">{{ $seats }}</span>
                        @endforeach 
                         
                    </div>
                </div>
                
                <!-- Fare Rules (Modal Dialog)
                ============================================= -->
                <div id="fare-rules" class="modal fade" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Fare Rules</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="false">Cancellation Fee</a></li>
                            <li class="nav-item"><a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Baggage Details</a></li>
                        </ul>
                        <div class="tab-content my-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="table-responsive-md">
                                <table class="table table-hover table-bordered bg-light">
                                <thead>
                                    <tr>
                                    <td>Hours before Departure</td>
                                    <td class="text-center">Refund Percentage</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>Before 0 Hrs.</td>
                                    <td class="text-center">0%</td>
                                    </tr>
                                    <tr>
                                    <td>Before 24 Hrs.</td>
                                    <td class="text-center">30%</td>
                                    </tr>
                                    <tr>
                                    <td>Before 48 Hrs.</td>
                                    <td class="text-center">60%</td>
                                    </tr>
                                    <tr>
                                    <td>Before 60 Hrs.</td>
                                    <td class="text-center">75%</td>
                                    </tr>
                                    <tr>
                                    <td>Above 60 Hrs. </td>
                                    <td class="text-center">80%</td>
                                    </tr>
                                </tbody>
                                </table>
                                <p class="font-weight-bold">Terms &amp; Conditions</p>
                                <ul>
                                <li>The penalty is subject to 24 hrs before departure. No Changes are allowed after that.</li>
                                <li>The charges are per seat.</li>
                                <li>Partial cancellation is not allowed on tickets booked under special discounted fares.</li>
                                <li>In case of no-show or ticket not cancelled within the stipulated time, only statutory taxes are refundable subject to Service Fee.</li>
                                </ul>
                            </div>
                            </div>
                            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                            <table class="table table-hover table-bordered bg-light">
                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <td class="text-center">Per Seat</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Adult</td>
                                    <td class="text-center">5 Kg</td>
                                </tr>
                                <tr>
                                    <td>Child</td>
                                    <td class="text-center">5 Kg</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div><!-- Fare Rules end -->
                
                </div>
            </div>
            <div class="alert alert-info mt-4"> <span class="badge badge-info">NOTE:</span> This is a special fare given by the Operator. Operator cancellation charges do apply. </div>
            <h2 class="text-6 mb-3 mt-5">Traveller Details</h2>
            <p class="font-weight-600">Contact Details</p>
            <div class="form-row">
                <div class="col-sm-6 form-group">
                <input class="form-control" id="email" placeholder="Enter Email" type="text" value="{{ Auth::user()->email }}" readonly>
                </div>
                <div class="col-sm-6 form-group">
                <input class="form-control" data-bv-field="number" id="mobileNumber" required placeholder="Enter Mobile Number" type="text" value="{{ Auth::user()->phone_number }}" readonly>
                </div>
            </div>
            <p class="text-info">Your booking details will be sent to this email address and mobile number.</p>
            <p class="font-weight-600">Adult 1</p>
            <div class="form-row">
                <div class="col-sm-2 form-group">
                    <input class="form-control" id="sex" required placeholder="sex" type="tel" value="{{ Auth::user()->sex }}" readonly>
                </div>
                <div class="col-sm-4 form-group">
                <input class="form-control" id="name" required placeholder="Enter First Name" type="text" value="{{ Auth::user()->name }}" readonly>
                </div>
            </div>
            </div>
        </div>
        
        <!-- Side Panel (Fare Details)
        ============================================= -->
        <aside class="col-lg-4 mt-4 mt-lg-0">
            <div class="bg-light shadow-md rounded p-3">
            <h3 class="text-5 mb-3">Fare Details</h3>
            <ul class="list-unstyled">
                <li class="mb-2">Base Fare <span class="float-right text-4 font-weight-500 text-dark">&#2547 {{ $bus->fair }}</span></li>
                <li class="mb-2">Number of Seats <span class="float-right text-4 font-weight-500 text-dark">{{ $numberOfSeats }}</span></li>
            </ul>
            <br><br><br>
            <div class="text-dark bg-light-4 text-4 font-weight-600 p-3 mb-1"> Total Amount <span class="float-right text-6">&#2547 {{ $totalPrice }}</span> </div>
            
            <button class="btn btn-primary btn-block" onclick="window.location.href='{{ route('checkout.index') }}'" type="submit">Proceed To Payment</button>
            </div>
        </aside><!-- Side Panel -->
        </div>
    </section>
</div><!-- Content end -->
<!-- Page Header end -->
@endsection