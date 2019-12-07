@extends('layouts.app')
@section('extra-css')
<script src="https://js.stripe.com/v3/"></script>
@endsection
@section('content')
     <!-- Page Header
  ============================================= -->
  <section class="page-header page-header-text-light bg-secondary">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h1>Payment</h1>
        </div>
        <div class="col-md-4">
          <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
            <li><a href="/">Home</a></li>
            <li class="active">Payment</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Header end --> 
  <!-- Message
  ============================================= -->
  @include('inc.message')
  <!-- Message end --> 
  
  <!-- Content
  ============================================= -->
  <div id="content">
    <div class="container">
      <div class="bg-light shadow-md rounded p-4">
        <h3 class="text-6 mb-4">Select a Payment Mode</h3>
        <div class="row">
          <div class="col-md-7 col-lg-8 order-1 order-md-0">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
              <li class="nav-item"> <a class="nav-link active" id="first-tab" data-toggle="tab" href="#firstTab" role="tab" aria-controls="firstTab" aria-selected="true">Credit/Debit Cards</a> </li>
              <li class="nav-item"> <a class="nav-link" id="second-tab" data-toggle="tab" href="#secondTab" role="tab" aria-controls="secondTab" aria-selected="false">bKash</a> </li>
            </ul>
            <div class="tab-content my-3" id="myTabContent"> 
              <!-- Cards Details
              ============================================= -->
              <div class="tab-pane fade show active" id="firstTab" role="tabpanel" aria-labelledby="first-tab">
                <div class="row">
                  <div class="col-lg-9">
                    <h3 class="text-4 mb-4">Enter Card Details</h3>
                    <form id="payment-form" method="post" action="{{ route('checkout.stripe') }}">
                        @csrf
                      <div class="form-group">
                        <label for="card-element">
                          Credit or debit card
                        </label>
                        <div id="card-element">
                          <!-- A Stripe Element will be inserted here. -->
                        </div>
                    
                        <!-- Used to display Element errors. -->
                        <div id="card-errors" role="alert"></div>
                      </div>
                      
                        
                      <div class="form-group">
                        <label for="cardHolderName">Card Holder Name</label>
                        <input type="text" class="form-control" data-bv-field="cardholdername" id="cardholder-name" name="cardHolderName" required placeholder="Card Holder Name">
                      </div>
                      <div class="form-group custom-control custom-checkbox">
                        <input id="save-card" name="savecard" class="custom-control-input" type="checkbox">
                        <label class="custom-control-label" for="save-card">Save my card Details.</label>
                      </div>
                      <button class="btn btn-primary btn-block" id="button"><div class="spinner hidden" id="spinner"></div><span id="button-text">Proceed to Pay &#2547 {{ $order->totalPrice }}</span></button>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Cards Details end --> 
              <!-- Pay via bKash
            ============================================= -->
            <div class="tab-pane fade" id="secondTab" role="tabpanel" aria-labelledby="second-tab"> <img class="img-fluid" src="images/bkash.png" alt="bKash" title="Pay easily, fast and secure with bKash.">
              <p class="lead">Pay easily, fast and secure with bKash.</p>
              <p class="text-info mb-4"><i class="fas fa-info-circle"></i> You will be redirected to bKash to complete your payment securely.</p>
              <button class="btn btn-bkash d-flex align-items-center" type="submit"><i class="fas fa-angle-right"></i> Pay via bKash</button>
            </div>
            <!-- Pay via bKash end --> 
            </div>
          </div>
          <div class="col-md-5 col-lg-4 order-0 order-md-1"> 
            
            <!-- Payable Amount
          ============================================= -->
            <div class="bg-light-2 rounded p-4 mb-4">
              <h3 class="text-4 mb-4">Payable Amount</h3>
              <ul class="list-unstyled">
                @if ($order->car_id !=0)
                <li class="mb-2">Amount <span class="float-right text-4 font-weight-500 text-dark">&#2547 {{ $order->carPrice }}</span></li> 
                @else
                <li class="mb-2">Amount <span class="float-right text-4 font-weight-500 text-dark">&#2547 {{ $order->totalPrice }}</span></li>   
                @endif
                
              </ul>
              <hr>
              @if ($order->car_id !=0)
              <div class="text-dark text-4 font-weight-500 py-1"> Total Amount<span class="float-right text-7">&#2547 {{ $order->carPrice }}</span></div>
              @else
              <div class="text-dark text-4 font-weight-500 py-1"> Total Amount<span class="float-right text-7">&#2547 {{ $order->totalPrice }}</span></div>  
              @endif
              
            </div>
            <!-- Payable Amount end --> 
            
            <!-- Privacy Information
          ============================================= -->
            <div class="bg-light-2 rounded p-4 d-none d-md-block">
              <p class="mb-2">We value your Privacy.</p>
              <p class="text-1 mb-0">We will not sell or distribute your contact information. Read our <a href="#">Privacy Policy</a>.</p>
              <hr>
              <p class="mb-2">Billing Enquiries</p>
              <p class="text-1 mb-0">Do not hesitate to reach our <a href="#">support team</a> if you have any queries.</p>
            </div>
            <!-- Privacy Information end --> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content end --> 
  <!-- Preloader -->
 
@endsection
@section('extra-js')
<script>

// Create a Stripe client.
var stripe = Stripe('pk_test_3DUbMQRZ1hCeys4dOt4hBED800mHPUFtjE');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {
  style: style,
  hidePostalCode: true
  });

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle form submission.
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
  event.preventDefault();
  
  changeLoadingState(true);


  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      changeLoadingState(false);

      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
// Show a spinner on payment submission
var changeLoadingState = function(isLoading) {
  if (isLoading) {
    document.querySelector("#button").disabled = true;
    document.querySelector("#spinner").classList.remove("hidden");
    document.querySelector("#button-text").classList.add("hidden");
  } else {
    document.querySelector("#button").disabled = false;
    document.querySelector("#spinner").classList.add("hidden");
    document.querySelector("#button-text").classList.remove("hidden");
  }
}

</script>
    
@endsection