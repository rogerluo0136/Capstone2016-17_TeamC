@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="panel panel-default">
            <div class="panel-heading">Checkout</div>
            <div class="panel-body">
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
                    </br>
                    <div id="payment-success" class="alert alert-success">
                        you're payment has successfully been processsed. An email receipt has been sent to you. 
                        please click <a href="{{url('/home')}}">here</a> to return to the dashboard.
                    </div>
                    <div id="payment-warning" class="alert alert-danger">
                        The payment was not successful. 
                        please click <a href="{{url('/home')}}">here</a> to return to the dashboard.
                    </div>
                    <br>
                    <h3>Balance Information</h3>
                    <ul>
                        <li>Balance: ${{$balance}}</li>

                        @if($cps->program_season_id != 0)
                            <li>Program: {{$cps->programSeason->program->name}}</li>
                            <li>Season: {{$cps->programSeason->season->season}}</li>
                        @else
                            <li>Program: Music Assessment</li>
                            <li>Season: N/A</li>
                        @endif
                        
                        <li>Date Registered: {{$cps->updated_at->toFormattedDateString()}}</li>
                        <li>Child Registered: {{$cps->child->name}}</li>
                    </ul>
                    <br>
                    <a  class="btn btn-warning" href="{{ url('/home') }}" style="width: 25%">Pay Later </a>
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
      @if($cps->program_season_id!=0)
        description: '{{$cps->programSeason->program->name}}',
      @else
        description: 'Music Assessment',
      @endif
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
