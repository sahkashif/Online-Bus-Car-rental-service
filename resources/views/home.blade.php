@extends('layouts.app')

@section('content')
@php
    use App\Order;
    use App\Stop;
    use App\Bus;
    use App\PaymentDetail;
    $orders= Order::where('user_id',Auth::user()->id)->get();
    $carorders = Order::where('user_id', Auth::user()->id)->where('car_id','!=', 0)->get();
@endphp
<!-- Message
============================================= -->
@include('inc.message')
<!-- Message end --> 
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" id="first-tab" data-toggle="tab" href="#firstTab" role="tab" aria-controls="firstTab" aria-selected="true">Bus Bookings</a> </li>
                        <li class="nav-item"> <a class="nav-link" id="second-tab" data-toggle="tab" href="#secondTab" role="tab" aria-controls="secondTab" aria-selected="false">Car Bookings</a> </li>
                    </ul>
                    <div class="tab-content my-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="firstTab" role="tabpanel" aria-labelledby="first-tab">
                            <div class="table-responsive-lg">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ORDER ID</th>
                                        <th scope="col">BUS ID</th>
                                        <th scope="col">FROM</th>
                                        <th scope="col">TO</th>
                                        <th scope="col">DEP. TIME</th>
                                        <th scope="col">NO. SEATS</th>
                                        <th scope="col">PAYMENT STATUS</th>
                                        <th scope="col">PAID AMOUNT</th>
                                        <th scope="col">DOWNLOAD</th>
                                        <th scope="col">CANCEL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    @if ($order->car_id == 0)
                                        
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>{{ $order->bus_id }}</td>
                                        <td>{{ Stop::find($order->start_stop_id)->name }}</td>
                                        <td>{{ Stop::find($order->end_stop_id)->name }}</td>
                                        <td>{{ date("d M Y, D; h:i A",strtotime($order->dep_time)) }}</td>
                                        <td>{{ $order->no_seats() }}</td>
                                        @if ($order->transection())
                                        <th scope="row" class="text-success">PAID</th>
                                        @else
                                        <th scope="row" class="text-warning">DUE</th>  
                                        @endif
                                        <td>{{ $order->price }}</td>
                                        <td><a href="{{ route('booking.export', $order->id) }}" class="btn btn-sm btn-outline-primary shadow-none" title="download ticket"><i class="fas fa-download"></i></a></td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#order-{{ $order->id }}" class="btn btn-sm btn-outline-danger shadow-none"><i class="far fa-calendar-times" title="cancel booking"></i></button>  
                                        </td>
                                    </tr>
                                        
                                    @endif
                                   
                                    @include('inc.ticket_cancelation')
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="secondTab" role="tabpanel" aria-labelledby="second-tab">
                            
                            <div class="table-responsive-lg">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ORDER ID</th>
                                            <th scope="col">CAR ID</th>
                                            <th scope="col">PICK-UP DATE</th>
                                            <th scope="col">DROP-OFF TIME</th>
                                            <th scope="col">PAYMENT STATUS</th>
                                            <th scope="col">PAID AMOUNT</th>
                                            <th scope="col">DOWNLOAD</th>
                                            <th scope="col">CANCEL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        @if ($order->car_id != 0)
                                            
                                        <tr>
                                            <th scope="row">{{ $order->id }}</th>
                                            <td>{{ $order->car_id }}</td>
                                            <td>{{ date("d M Y, h:i A",strtotime($order->pick_up_date)) }}</td>
                                            <td>{{ date("d M Y, h:i A",strtotime($order->drop_off_date)) }}</td>
                                            @if ($order->transection())
                                            <th scope="row" class="text-success">PAID</th>
                                            @else
                                            <th scope="row" class="text-warning">DUE</th>  
                                            @endif
                                            <td>{{ $order->price }}</td>
                                            <td><a href="{{ route('booking.export', $order->id) }}" class="btn btn-sm btn-outline-primary shadow-none" title="download ticket"><i class="fas fa-download"></i></a></td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#order-{{ $order->id }}" class="btn btn-sm btn-outline-danger shadow-none"><i class="far fa-calendar-times" title="cancel booking"></i></button>  
                                            </td>
                                        </tr>
                                            
                                        @endif
                                        
                                        @include('inc.ticket_cancelation')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br>
@endsection
