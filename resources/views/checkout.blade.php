@extends('layouts.app')

@section('content')

	<div class="container">
		

		<button class="btn btn-primary" id="FullPayment">Pay Full Amount</button>

		
	</div>
@endsection

@section('js')
	<script src="https://checkout.stripe.com/checkout.js"></script>
	<script>
	  console.log('children:'+{!! $children !!});
	  var handler = StripeCheckout.configure({
	    key: 'pk_test_UVV1otpLUnlvUykwoDCvc0JE',
	    locale: 'auto',
	    token: function(token) {
		    console.log('token used for charging'+token);
		     
	    	$.ajaxSetup({
	        	headers: {
	            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	}
	    	});
	    	
	    	$.ajax({
		      	url:'{{URL::action("TransactionController@store")}}',
		      	data:{
		      		token:token,
		      		children:{!! $children !!},
		      		program_season: {!! $program_season !!},
		      		price: {{ $price }}
			    },
			    type:'POST'
	      	});
	    }
	  });

	  $('#FullPayment').on('click', function(e) {
	    // Open Checkout with further options
	    handler.open({
	      name: 'Holland Bloorview Hospital',
	      description: '{{ $program_season->program->name }}',
	      currency: "cad",
	      amount: {{ $price*100 }}
	    });
	    e.preventDefault();
	  });

	  // Close Checkout on page navigation
	  $(window).on('popstate', function() {
	    handler.close();
	  });
	</script>
@endsection