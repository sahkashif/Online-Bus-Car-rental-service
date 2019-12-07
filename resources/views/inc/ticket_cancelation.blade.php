<div class="modal fade" id="order-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="ticketCancellation" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="order-{{ $order->id }}-label">Ticket Cancellation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
                <h4 class="h6"> 0 Hrs before departure</h4> 
                <p>Refund Percentage: 0% </p>
            </div>
            <div>
                <h4 class="h6">24 Hrs before departure</h4>
                <p>Refund Percentage: 30%</p>
            </div>
            <div>
                <h4 class="h6">48 Hrs before departure</h4>
                <p>Refund Percentage: 60%</p>
            </div>
            <div>
                <h4 class="h6">60 Hrs before departure</h4>
                <p>Refund Percentage: 75%</p>
            </div>
            <div>
                <h4 class="h6">Above 60 Hrs before departure</h4>
                <p>Refund Percentage: 80%</p>
            </div>
            <div>
                <h4 class="h6">0 Hrs before departure</h4>
                <p>Refund Percentage: 0%</p>
            </div>
            <p class="font-weight-bold">Terms & Conditions</p>
            <ul>
                <li>The penalty is subject to 24 hrs before departure. No Changes are allowed after that.</li>
                <li>The charges are per seat.</li>
                <li>Partial cancellation is not allowed on tickets booked under special discounted fares.</li>
                <li>In case of no-show or ticket not cancelled within the stipulated time, only statutory taxes are refundable subject to Service Fee.</li>
            </ul>
          </div>
          <div class="modal-footer">
            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="/booking/{{ $order->id }}" method="POST">
                @method('DELETE')
                @csrf
                
                <button type="submit" class="btn btn-danger">Cancel Booking</button>
            </form>
          </div>
        </div>
      </div>
    
  </div>