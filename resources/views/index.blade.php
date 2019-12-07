@extends('layouts.app')

@section('content')

<div class="bg-secondary">
	<div class="container">
		<ul class="nav secondary-nav nav-tabs">
			<li> <a data-toggle="tab" class="nav-link active" href="#home"><span><i class="fas fa-bus"></i></span> Bus</a> </li>
			<li> <a data-toggle="tab" class="nav-link" href="#car"><span><i class="fas fa-car"></i></span> Cars</a> </li>
			
		</ul>
		
			
			
			
	</div>
</div>
<!-- Message
  ============================================= -->
  @include('inc.message')
  <!-- Message end --> 
<div class="tab-content">
	<div id="home" class="tab-pane active">
		<section class="container">
			<div class="bg-light shadow-md rounded p-4">
				<div class="row">
					<div class="col-lg-5 mb-4 mb-lg-0">
						<h2 class="text-4 mb-3">Book Bus Tickets</h2>
						
						<form id="bookingBus" method="GET" action={{ route('search.bus') }}>
							@csrf
							<div class="form-row">
								<div class="col-lg-6 form-group">
									<label>FROM</label>
									<select class="form-control" name="from">
										@foreach ($districts as $district)
										<optgroup label="{{ $district->name }}">
											@foreach ($district->stops as $stop)
												<option value="{{ $stop->id }}">{{ $stop->name }}</option>
											@endforeach
											</optgroup>
										@endforeach
									</select>
								</div>
								<div class="col-lg-6 form-group">
									<label>TO</label>
									<select class="form-control" name="to">
										@foreach ($districts as $district)
										<optgroup label="{{ $district->name }}">
											@foreach ($district->stops as $stop)
												<option value="{{ $stop->id }}">{{ $stop->name }}</option>
											@endforeach
										</optgroup>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="col form-group">
									<label>DEPARTURE DATE & TIME</label>
									<input id="busDepart" name="datetime" type="datetime-local" class="form-control" required placeholder="Depart Date">
								</div>
							</div>
							
							<button class="btn btn-primary btn-block" type="SUBMIT">Search Bus</button>
						</form>
				</div>
				<!-- Slideshow
				============================================= -->
				<div class="col-lg-7">
				<div class="owl-carousel owl-theme single-slider" data-animateout="fadeOut" data-animatein="fadeIn" data-autoplay="true" data-loop="true" data-autoheight="true" data-nav="true" data-items="1">
					<div class="item"><a href="#"><img class="img-fluid" src="images/slider/booking-banner-2.jpg" alt="banner 2" /></a></div>
					<!-- <div class="item"><a href="#"><img class="img-fluid" src="images/slider/booking-banner-3.jpg" alt="banner 3" /></a></div> -->
				</div>
				</div><!-- Slideshow end -->
				</div>
			</div>
		</section>
	</div>
	<div id="car" class="tab-pane fade">
		<div id="content">
			<section class="container">
				<div class="bg-light shadow-md rounded p-4">
					<div class="row">
						<div class="col-lg-5 mb-4 mb-lg-0">
							<!-- Car Search Form
							============================================= -->
							<h2 class="text-4 mb-3">Book Car Rental </h2>
								<!-- Car Search Form end -->
								<form id="bookingCars" method="get" action="{{ route('search.car') }}">
									@csrf
									<div class="form-row">
										<div class="col-lg form-group">
											<select class="form-control" name="loc">
												@foreach ($districts as $district)
												<optgroup label="{{ $district->name }}">
													@foreach ($district->stops as $stop)
														<option value="{{ $stop->id }}">{{ $stop->name }}</option>
													@endforeach
													</optgroup>
												@endforeach
											</select>
										<span class="icon-inside"><i class="fas fa-map-marker-alt"></i></span> </div>
									</div>
									<div class="form-row no-gutters">
										<div class="col form-group">
											<label>Pick-up Date & Time</label>
											<input id="carDepart1" name="pickupdate" type="datetime-local" class="form-control" required placeholder="Depart Date"> 
										</div>
									</div>
									<div class="form-row">
										<div class="col form-group">
											<label>Drop Off Date & Time</label>
											<input id="carDepart1" name="dropoffdate" type="datetime-local" class="form-control" required placeholder="Depart Date"> 
										</div>
									</div>
									<div class="custom-control custom-checkbox mb-3">
									<input type="checkbox" id="terms" name="termsConditions" checked="" class="custom-control-input">
									<label class="custom-control-label d-block" for="terms">Driver aged 25 - 70 <span class="text-info" data-toggle="tooltip" data-original-title="Car rental suppliers may charge more if a driver is under 30 or over 60. Please check the car's terms &amp; conditions."><i class="far fa-question-circle"></i></span></label>
									</div>
									<div class="travellers-class form-group">
											<input type="text" id="busTravellersClass"  class="travellers-class-input form-control" name="bus-travellers-class" placeholder="Seats" readonly required onkeypress="return false;">
											<span class="icon-inside"><i class="fas fa-caret-down"></i></span>
											<div class="travellers-dropdown">
											<div class="row align-items-center mb-3">
												<div class="col-sm-7">
												<p class="mb-sm-0">Seats</p>
												</div>
												<div class="col-sm-5">
												<div class="qty input-group">
													<div class="input-group-prepend">
														<button type="button" class="btn bg-light-4" data-value="decrease" data-target="#adult-travellers" data-toggle="spinner">-</button>
													</div>
													<input type="text" name="seats" data-ride="spinner" id="adult-travellers" class="qty-spinner form-control" value="1" readonly>
													<div class="input-group-append">
														<button type="button" class="btn bg-light-4" data-value="increase" data-target="#adult-travellers" data-toggle="spinner">+</button>
													</div>
												</div>
												</div>
											</div>
											<button class="btn btn-primary btn-block submit-done" type="button">Done</button>
											</div>
										</div>
										<button class="btn btn-primary btn-block" type="SUBMIT">Search Car</button>
							
						</form><!-- Car Search Form end -->
					</div>
						<!-- Slideshow
						============================================= -->
						<div class="col-lg-7">
							<div class="owl-carousel owl-theme single-slider" data-animateout="fadeOut" data-animatein="fadeIn" data-autoplay="true" data-loop="true" data-autoheight="true" data-nav="true" data-items="1">
								<div class="item"><a href="#"><img class="img-fluid" src="images/slider/booking-banner-9.jpg" alt="banner 7" /></a></div>
								</div>
							</div><!-- Slideshow end -->
						</div>
					</div>
			</section>
		</div>
</div>


@endsection
