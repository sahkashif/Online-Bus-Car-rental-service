@extends('layouts.app')
@section('content')
    <!-- Page Header
============================================= -->
<section class="page-header page-header-text-light bg-secondary">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-8">
            <h1>Bus || Update Scheduler</h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                <li><a href="/">Home</a></li>
                <li class="active">Scheduler</li>
            </ul>
            
        </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">SCHEDULER</div>
                    @include('inc.message')
                    <div class="card-body">
                    <form method="post" action={{ route('admin.scheduler.update') }}>
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Select a BUS</label>
                                   <select class="form-control" name="bus" id="bus">
                                       @foreach ($buses as $bus)
                                           <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-4 form-group">
                                    <label>FROM</label>
                                    <select class="form-control" name="from" id="from">
                                       
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>ARRIVAL DATE & TIME</label>
                                    <input id="fromarrtime" name="fromarrtime" type="datetime-local" class="form-control" required>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>DEPARTURE DATE & TIME</label>
                                    <input id="fromdeptime" name="fromdeptime" type="datetime-local" class="form-control" required>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                    <div class="col-lg-4 form-group">
                                        <label>TO</label>
                                        <select class="form-control" name="to" id="to">
                                           
                                        </select>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label>ARRIVAL DATE & TIME</label>
                                        <input id="fromarrtime" name="toarrtime" type="datetime-local" class="form-control" required>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label>DEPARTURE DATE & TIME</label>
                                        <input id="fromdeptime" name="todeptime" type="datetime-local" class="form-control" required>
                                    </div>
                                </div>
                            <button class="btn btn-success btn-block" type="SUBMIT">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<br><br><br>
<script>
$("#bus").on('change', function(){
    $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $.ajax({
        type     : 'get',
        url      : '/api/stops/'+$('#bus').val(),
        dataType : 'json',
        success  : function(response) {
            //iterate through all bookings for our event 
            //console.log(response.stops);
            $('#from option').remove();
            $('#to option').remove();
            $.each(response.stops, function(index, stop) {
                
                $('#from').append(`<option value="${stop.id}"> 
                                    ${stop.name} 
                                </option>`);
                console.log(stop.name);
                $('#to').append(`<option value="${stop.id}"> 
                                    ${stop.name} 
                                </option>`);
                console.log(stop.name);

            }  
           
            
            );}
            
    });
});
</script>
@endsection