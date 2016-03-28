@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Checkout</h1>
        <br>
        
        
        <div class="col-md-6">
            <h3>Conduct Payment</h3>
            <form id="payment-form" class="form-inline" action="{{URL::action('TransactionController@settle',[$cps->id])}}">
              <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                <div class="input-group">
                  <div class="input-group-addon">$</div>
                  <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" value='{{$balance}}' required>
                </div>
              </div>
              <button id="balance-btn"  class="btn btn-primary">Pay Balance</button>
            </form>
            
            <div id="payment-success" class="alert alert-success">
                you're payment has successfully been processsed. An email receipt has been sent to you. 
                please click <a href="{{url('/home')}}">here</a> to return to the dashboard.
            </div>
            <div id="payment-warning" class="alert alert-danger"></div>
            
            <br>
            <h3>Balance Information</h3>
            <ul>
                <li>Balance: ${{$balance}}</li>
                <li>Program: {{$cps->programSeason->program->name}}</li>
                <li>Season: {{$cps->programSeason->season->season}}</li>
                <li>Date Registered: {{$cps->updated_at->toFormattedDateString()}}</li>
                <li>Child Registered: {{$cps->child->name}}</li>
            </ul>
            
            <br>
            <h3>Note</h3>
            <p>
                Please ensure to settle your balance before the end of the program season. If there are any children
                under your account that have an unsettled bill past the season end you will be banned from registering
                from future programs till all outstanding balances are settled.
            </p>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="https://checkout.stripe.com/checkout.js"></script>

<script>
  $('.alert').hide();
  var handler = StripeCheckout.configure({
    key: 'pk_test_6pRNASCoBOKtIshFeQd4XMUh',
    locale: 'auto',
    token: function(token) {
        $.ajaxSetup({
        	headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
        });
        $.ajax({
            url: $('#payment-form').attr('action'),
            data:{
                token:token,
                amount:$('#amount').val()*100,
            },
            type:'POST',
            success: function(result){
               $('#payment-success').show();
            },
            error: function(x,e){
                message=x.message;
                $('#payment-warning').html(message);
                $('#payment-warning').show();
            }
        });
    }
  });

  $('#balance-btn').on('click', function(e) {
    $('.alert').hide();
    
    //ensure that the input has a value
    if(!$('#amount').val()){
        $('#payment-warning').html('please place an amount before submitting.');
        $('#payment-warning').show();
        return;
    }
    
    // Open Checkout with further options
    handler.open({
      name: 'Holland Bloorview',
      description: '{{$cps->programSeason->program->name}}',
      amount: $('#amount').val()*100,
      email: '{{Auth::user()->email}}'
    });
    e.preventDefault();
  });

  // Close Checkout on page navigation
  $(window).on('popstate', function() {
    handler.close();
  });
</script>
@endsection
