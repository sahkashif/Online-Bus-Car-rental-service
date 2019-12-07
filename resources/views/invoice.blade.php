<!DOCTYPE html>
<html lang="en">


<head>

<body>
@php
    use App\Stop;
    use App\User;
    use App\Bus;
    use App\Car;
@endphp
<div class="container-fluid invoice-container">
    <div class="row align-items-center">
      <div class="col-sm-7 text-center text-sm-left">
        
      </div>
      <div class="col-sm-5 text-center text-sm-right">
        <h4 class="mb-0">Invoice</h4>
        <p class="mb-0">Invoice Number - {{ $order['id'] }}</p>
      </div>
    </div>
    <hr class="my-4">
    @if ($order['is_car'] == 0)
    <div class="row">
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">From:</span><br>
        <span class="font-weight-500 text-3">{{ Stop::find($order['start_stop_id'])->name }}</span> </div>
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">To:</span><br>
        <span class="font-weight-500 text-3">{{ Stop::find($order['end_stop_id'])->name }}</span> </div>
        <div class="col-sm-4"> <span class="text-black-50 text-uppercase">Date of Journey</span><br>
        <span class="font-weight-500 text-3">{{ date("d M Y, D",strtotime($order['dep_time'])) }}</span> </div>
    </div>
    <hr class="my-4">
    <div class="row">
      <div class="col-sm-3 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Reporting Time:</span><br>
        <span class="font-weight-500 text-3">{{ date("h:i A",strtotime($order['arr_time'])) }}</span> </div>
      <div class="col-sm-3 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Departure Time:</span><br>
        <span class="font-weight-500 text-3">{{ date("h:i A",strtotime($order['dep_time'])) }}</span> </div>
        <div class="col-sm-3 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Status</span><br>
        <span class="font-weight-500 text-3">Booked</span> </div>
        <div class="col-sm-3"> <span class="text-black-50 text-uppercase">Ticket ID</span><br>
        <span class="font-weight-500 text-3">QNOP3912</span> </div>
    </div>
    @else
    <hr class="my-4">
    <div class="row">
      <div class="col-sm-3 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Pick-up Time:</span><br>
        <span class="font-weight-500 text-3">{{ date("h:i A",strtotime($order['pick_up_date'])) }}</span> </div>
      <div class="col-sm-3 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Drop-off Time:</span><br>
        <span class="font-weight-500 text-3">{{ date("h:i A",strtotime($order['drop_off_date'])) }}</span> </div>
        <div class="col-sm-3 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Status</span><br>
        <span class="font-weight-500 text-3">Booked</span> </div>
        <div class="col-sm-3"> <span class="text-black-50 text-uppercase">Ticket ID</span><br>
        <span class="font-weight-500 text-3">QNOP3912</span> </div>
    </div>
    @endif
   
    
    <hr class="my-4">
    <div class="row">
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Passenger Name:</span><br>
        <span class="font-weight-500 text-3">{{ User::find($order['user_id'])->name }}</span> </div>
      <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Seat:</span><br>
        <span class="font-weight-500 text-3"></span> </div>
        <div class="col-sm-4"> <span class="text-black-50 text-uppercase">Ticket PNR</span><br>
        <span class="font-weight-500 text-3">5977747-4444152</span> </div>
    </div>
    <hr class="my-4">
    <div class="row">
        <div class="col-sm-4 mb-3 mb-sm-0"> <span class="text-black-50 text-uppercase">Travels</span><br>
      @if ($order['is_car'] == 0)
      <span class="font-weight-500 text-3">{{ Bus::find($order['bus_id'])->name }}</span> </div>
      @else
      <span class="font-weight-500 text-3">{{ Car::find($order['car_id'])->name }}</span> </div> 
      @endif
        
          
        
    </div>
        <p class="bg-light-4 p-3 text-right font-weight-500 text-4 rounded my-4">Total Fare: <span class="pl-2">&#2547 {{ $order['price'] }}</span> </p>
        
        <p class="text-center text-black-50">**Always Carry ticket print out and your ID proof while traveling.</p>
    <hr class="my-4">
    <p class="text-center"><strong>Quickai Inc.</strong><br>
     Dhaka, Bangladesh<br>
      Suite 100-18, Dhanmondi DACCA 2028. </p>
      <hr>
    <p class="text-center text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
    <div class="text-center">
      <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> <a href="#" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</a> </div>
    </div>
  </div>
  <p class="text-center d-print-none"><a href="/home">&laquo; Back to My Account</a></a></p>   
</body>


</html>