<!-- Bus Details (Select Seats) Modal Dialog
============================================= -->
<div id="select-busseats-{{ $result['bus']->id }}" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Bus Booking Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
          <div class="bus-details">
          <div class="row align-items-sm-center flex-row mb-4">
              <div class="col col-sm-3"> <span class="text-3 text-dark operator-name">{{ $result['bus']->name }}</span><span class="text-muted d-block">AC Sleeper</span> </div>
              <div class="col col-sm-3 text-center time-info">
                <span class="text-2 text-dark">{{ $result['dep_time']->dep_time }}</span>
                <input id="dep_time-{{ $result['bus']->id }}" type="hidden" value="{{ $result['dep_time']->dep_time }}">
                <small class="text-muted d-block">{{ $from->name }}</small>
              </div>
              <div class="col col-sm-3 text-center time-info">
                <span class="text-2 text-dark">{{ $result['arr_time']->arr_time }}</span>
                <input id="arr_time-{{ $result['bus']->id }}" type="hidden" value="{{ $result['arr_time']->arr_time }}">
                <small class="text-muted d-block">{{ $to->name }}</small>
              </div>
          </div>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item"> <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Available Seats</a> </li>
              <li class="nav-item"> <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Cancellation Fee</a> </li>
          </ul>
          <div class="tab-content my-3" id="myTabContent">
              <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
              <div class="row">
                <div class="col-12 col-lg-6 text-center">
                  <p class="text-muted text-1">Click on Seat to select/ deselect</p>
                  <div id="seat-map-{{ $result['bus']->id }}">
                        <div class="front-indicator">Front</div>
                  </div>
                  <div id="legend-{{ $result['bus']->id }}"></div>
                </div>
                <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                    
                    <div class="booking-details">
                        <h2 class="text-5">Booking Details</h2>
                        <p>Selected Seats (<span id="counter-{{ $result['bus']->id }}">0</span>):</p>
                        <ul id="selected-seats-{{ $result['bus']->id }}">
                        </ul>
                        <div class="d-flex bg-light-4 px-3 py-2 mb-3">Total Fare: 
                          <span class="text-dark text-5 font-weight-600 ml-2">&#2547
                            <span id="total-{{ $result['bus']->id }}">0</span>
                          </span>
                        </div>
                        <button class="btn btn-primary btn-block" id="bal-{{ $result['bus']->id }}">Continue</button>
                        <div id="chet"></div>
                    </div>
                    
                </div>
                </div>
              </div>
              <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
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
              <p class="font-weight-bold">Terms & Conditions</p>
              <ul>
                  <li>The penalty is subject to 24 hrs before departure. No Changes are allowed after that.</li>
                  <li>The charges are per seat.</li>
                  <li>Partial cancellation is not allowed on tickets booked under special discounted fares.</li>
                  <li>In case of no-show or ticket not cancelled within the stipulated time, only statutory taxes are refundable subject to Service Fee.</li>
              </ul>
              </div>
          </div>
          </div>
      </div>
      </div>
  </div>
  </div><!-- Bus Details Modal Dialog end -->
  
  <!-- Script -->

  <script>	
  // Seat Charts
    var selectedSeats = [];
    var firstSeatLabel = 1;
    $(document).ready(function() {
        var $cart = $('#selected-seats-{!! $result["bus"]->id !!}'),
          $counter = $('#counter-{!! $result["bus"]->id !!}'),
          $total = $('#total-{!! $result["bus"]->id !!}'),
          sc = $('#seat-map-{!! $result["bus"]->id !!}').seatCharts({
          map: [
            'ff_ff',
            'ff_ff',
            'ee_ee',
            'ee_ee',
            'ee___',
            'ee_ee',
            'ee_ee',
            'ee_ee',
            'eeeee',
          ],
          
          seats: {
            f: {
              price   : {{ $result['bus']->fair }},
              classes : 'first-class', //your custom CSS class
              category: 'First Class'
            },
            e: {
              price   : {{ $result['bus']->fair }},
              classes : 'economy-class', //your custom CSS class
              category: 'Economy Class'
            }					
          
          },
          naming : {
            top : false,
            getLabel : function (character, row, column) {
              if(firstSeatLabel==36){
                firstSeatLabel=1;
              }
              return firstSeatLabel++;
            },
          },
          legend : {
            node : $('#legend-{!! $result["bus"]->id !!}'),
            items : [
              [ 'f', 'available',   'First Class' ],
              [ 'e', 'available',   'Economy Class'],
              [ 'f', 'unavailable', 'Already Booked']
            ]					
          },
          click: function () {
            if (this.status() == 'available') {
              //let's create a new <li> which we'll add to the cart items
              $('<li>'+this.data().category+' Seat # '+this.settings.label+': <b> &#2547'+this.data().price+'</b> <a href="#" class="cancel-cart-item text-danger text-4"><i class="far fa-times-circle"></i></a></li>')
                .attr('id', 'cart-item-'+this.settings.id)
                .data('seatId', this.settings.id)
                .appendTo($cart);
              
              /*
               * Lets update the counter and total
               *
               * .find function will not find the current seat, because it will change its stauts only after return
               * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
               */
              selectedSeats.push(this.node()[0].id);
              
              $counter.text(sc.find('selected').length+1);
              $total.text(recalculateTotal(sc)+this.data().price);
              console.log(selectedSeats);
              
              return 'selected';
            } else if (this.status() == 'selected') {
              selectedSeats.splice(selectedSeats.indexOf(this.node()[0].id), 1);
              
              //update the counter
              $counter.text(sc.find('selected').length-1);
              //and total
              $total.text(recalculateTotal(sc)-this.data().price);
              
              //remove the item from our cart
              $('#cart-item-'+this.settings.id).remove();
            
              //seat has been vacated
              return 'available';
            } else if (this.status() == 'unavailable') {
              //seat has been already booked
              return 'unavailable';
            } else {
              return this.style();
            }
          }
        });
  
        //this will handle "[cancel]" link clicks
        $('#selected-seats-{!! $result["bus"]->id !!}').on('click', '.cancel-cart-item', function () {
          //let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
          sc.get($(this).parents('li:first').data('seatId')).click();
        });
  
        //let's pretend some seats have already been booked
        //sc.get(['1_2', '4_1', '7_1', '7_2']).status('unavailable');
  
          setInterval(function() {
              $.ajax({
              type     : 'get',
              url      : '/api/seats/booked/{!! $result["bus"]->id !!}',
              dataType : 'json',
              success  : function(response) {
                  //iterate through all bookings for our event 
                  $.each(response.bookings, function(index, booking) {
                      //find seat by id and set its status to unavailable
                      console.log(booking.seat_code);
                      sc.status(booking.seat_code, 'unavailable');
                  });},
            });
          }, 10000);
    
    });
    function recalculateTotal(sc) {
      var total = 0;
    
      //basically find every selected seat and sum its price
      sc.find('selected').each(function () {
        total += this.data().price;
      });
      
      return total;
    }

$('#bal-{{  $result["bus"]->id  }}').click(function(){
  var arr_time=$('#arr_time-{{ $result["bus"]->id }}').val();
  var dep_time = $('#dep_time-{{ $result["bus"]->id }}').val();
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  if(selectedSeats.length != 0){
    $.ajax({
      url: '/session',
      type: 'post',
      data: { id :  {{ $result['bus']->id }},
              seats : JSON.stringify(selectedSeats),
              fromId :  {{ $from->id }},
              depTime : dep_time,
              toId :  {{ $to->id }},
              arrTime : arr_time,
            },
      dataType: 'JSON',
      success: function(data)
      {
        alert("Your selected seats are "+ data+ ". Press ok to checkout!");
        window.location = '/booking/create';
      }
  });
  }else{
    alert("please select seat");
  }
  
});
    
    

</script>
<script src="js/theme.js"></script> 