@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="panel panel-default padder">
			<div class="row">
				<div class="col-xs-12">
					<h1>{{$program_season->program->name}} Checkout Page</h1>
					<h3>Choose a payment option</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<h3>Option 1</h1>
					<h3>Price: ${{ $price }} (full amount)</h3>
					<p>
						You can pay the full amount now and be hassle free.
					</p>
					<button class="btn btn-primary" id="FullPayment">Pay Full Amount</button>
					<!--append success/error message here message here on response to customer-->
					<div id="fullAmountSuccess" class="alert alert-success">Success, your children have successfully enrolled into the program, click <b><a href="{{url('/home')}}">here</a></b> to return to your dashboard</div>
					<div id="fullAmountFail" class="alert alert-danger"></div>
				</div>
			</div>
			
			<hr>
			
			<div class="row">
				<div class="col-xs-12">
					<h3>Option 2</h3>
					<h3>Price: ${{ $minprice }} (initial deposit)</h3>
					<p>
						By an initial deposit, your children can ensure a spot in the
						program. A balance will be opened for you to complete your payments in 
						the future. Please ensure that you pay off this balance before the program end 
						to be able to register with Holland Bloorview's programs again
					</p>
					<button class="btn btn-primary" id="PartialPayment">Pay Deposit</button>
					<!--append success/error message here message here on response to customer-->
					<div id="minAmountSuccess" class="alert alert-success">Success, your children have successfully enrolled into the program, click <b><a href="{{url('/home')}}">here</a></b> to return to your dashboard</div>
					<div id="minAmountFail" class="alert alert-danger"></div>
				</div>
			</div>
			
			<hr>
			
			<div class="row">
				<div class="col-xs-12">
					<h3>Option 3</h3>
					<h3>Pay Cash/Cheque</h3>
					<p>
						If you do not want to pay with credit card, you can still pay in cash or cheque at the hospital. If you have any additional question,
						you may contact admin@example.com to resolve your questions.
					</p>
					
					<button id="cashButton" class="btn btn-primary">Pay Offline</button>
					<div id="cashSuccess" class="alert alert-success">
						Your intention has been registered. Please come to the hospital and pay to enroll your child to the program.  
						Click <b><a href="{{url('/home')}}">here</a></b> to return to your dashboard.
					</div>
				</div>
			</div>
			
			<hr>
			
			<div class="row">
				<div class="col-xs-12">
					<h3>Option 4</h3>
					<h3>Apply For Funding</h3>
					<!--
					<form action="upload.php" id="fileuploader" method="post" enctype="multipart/form-data">
					    <p>
							Optionally, you may not pay for the program and, in stead, provide evidence of your funding application. Please upload
							a document that displays a form of verification of your funding application. Currently, we accept pdf and image files.
						</p>
					    <input type="file" name="fundingFile" id="fundingFile">
					    
					    <input type="hidden" name="children">
					    <input type="hidden" name="program_season">
					    <button  type="submit" class="btn btn-primary">Upload File</button>
					</form>-->
					<p>
						Optionally, you may provide proof of funding in order to be defered from paying the program fees. If you choose to do so, please email example@example.com with your application proof. 
						Additionally you may choose to provide this proof in person at the hospital.
					</p>
					<button id="fundingButton" class="btn btn-primary">Funding Option</button>
					<div id="fundingSuccess" class="alert alert-success">
						Your funding intention has been registered. Ensure to send the application to the program administrators before the its start.   
						Click <b><a href="{{url('/home')}}">here</a></b> to return to your dashboard.
					</div>
				</div>
			</div>
		</div>
		
		
		
		
	</div>
@endsection

@section('js')
	<script src="https://checkout.stripe.com/checkout.js"></script>
	<script>
	$(function() {
    //full payment handler
	  $('.alert').hide();
	  var handlerFull = StripeCheckout.configure({
	    key: 'pk_test_UVV1otpLUnlvUykwoDCvc0JE',
	    locale: 'auto',
	    token: function(token) {
		 	console.log(token);
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
		      		payment_method:'online',
		      		program_season: {!! $program_season !!},
		      		price: {{ $price }}
			    },
			    type:'POST',
			    success: function (result){
			    	console.log('in full amount success function');
			    	$('#fullAmountSuccess').show();
			    },
			    error: function (x,e){
			    	if(x.status==500){
			    		message=x.message
			    	}else{
			    		message="Some of the children you are trying to register are already enrolled into the program.";
			    	}
			    	console.log('message is set:'+message);
			    	$('#fullAmountFail').html(message);
			    	$('#fullAmountFail').show();
			    	
			    }
	      	});
	    }
	  });

	  $('#FullPayment').on('click', function(e) {
	    // Open Checkout with further options
	    handlerFull.open({
	      name: 'Holland Bloorview Hospital',
	      description: '{{ $program_season->program->name }}',
	      currency: "cad",
	      amount: {{ $price*100 }},
	      email: '{{Auth::user()->email}}'
	    });
	    e.preventDefault();
	  });

	  // Close Checkout on page navigation
	  $(window).on('popstate', function() {
	    handlerFull.close();
	  });
	});
	  
	</script>
	
	
	
	
	
	
	<script>
	  //partial payment handler
	  console.log('children:'+ {!! $children !!});
	  var handlerPartial = StripeCheckout.configure({
	    key: 'pk_test_UVV1otpLUnlvUykwoDCvc0JE',
	    locale: 'auto',
	    token: function(token) {
		    console.log(token);
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
		      		payment_method:'online',
		      		program_season: {!! $program_season !!},
		      		price: {{ $minprice }}
			    },
			    type:'POST',
			    success: function (result){
			    	
			    	$('#minAmountSuccess').show();
			    },
			    error: function (x,e){
			    	if(x.status==500){
			    		message=x.message
			    	}else{
			    		message="Some of the children you are trying to register are already enrolled into the program.";
			    	}
			    	console.log('message is set:'+message);
			    	$('#minAmountFail').html(message);
			    	$('#minAmountFail').show();
			    	
			    }
	      	});
	    }
	  });

	  $('#PartialPayment').on('click', function(e) {
	    // Open Checkout with further options
	    handlerPartial.open({
	      name: 'Holland Bloorview Hospital',
	      description: '{{ $program_season->program->name }}',
	      currency: "cad",
	      amount: {{ $minprice*100 }},
	      email: '{{Auth::user()->email}}'
	    });
	    e.preventDefault();
	  });

	  // Close Checkout on page navigation
	  $(window).on('popstate', function() {
	    handlerPartial.close();
	  });
	</script>
	
	
	
	
	<script>
		$(function() {
			$('#fileuploader').submit( function(e){
				//prevent form from sending
				console.log($('#fundingFile')[0].files[0])
				e.preventDefault();
				console.log('pressed upload button');
				//retrieve the form data
				var formData = new FormData();
				console.log($(':file').val());
				//formData.append( 'fundingFile', $(':file').val());
				formData.append( 'children', {!! $children !!} );
				formData.append( 'program_season', {!! $program_season !!} );
				
				console.log(formData);
				
				//set up laravel styled ajax
		    	$.ajaxSetup({
		        	headers: {
		            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        	}
		    	});
		    	console.log('prepared ajax');
		    	//send ajax request
		    	/*
			      	data:{
			      		
			      		children:{!! $children !!},
			      		program_season: {!! $program_season !!},
			      		fundingFile: $(':file').val()
				    },*/
		    	/*
				$.ajax({
			      	url:'{{URL::action("ChildProgramSeasonController@fundingFileUpload")}}',
			      	
				    data:formData,
				    type:'POST',
				    success: function (result){
				    	console.log('in success function');
				    	$('#fundingSuccess').show();
				    },
				    error: function (jqXhr){
				    
				        
				        if( jqXhr.status === 422 ) {
				        //process validation errors here.
				        $errors = jqXhr.responseJSON; //this will get the errors response data.
				        //show them somewhere in the markup
				        //e.g
				        errorsHtml = '<div class="alert alert-danger"><ul>';
				
				        $.each( data, function( key, value ) {
				            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
				        });
				        errorsHtml += '</ul></di>';
				       
				        $('#fileuploader').append(errorsHtml);
				        
				        } else {
				             errorsHtml = '<div class="alert alert-danger"> You are conducting an unauthorized action </div>';
				             $('#fileuploader').append(errorsHtml);
				        }
				    }
		      	});*/
		      	var formData=new FormData();
		      	formData.append('fundingFile',$('#fundingFile')[0].files[0]);
		      	//formData.append('children',{!! $children !!});
		      	//formData.append('program_season',{!! $program_season !!});
		      	
		      	//this ajax does not work: please fix this
		      	$.ajax('{{URL::action("ChildProgramSeasonController@fundingFileUpload")}}',{
		      		type:'POST',
		      		
				  	contentType: false,
				  	processData:false,
		      		data:formData,
				    error: function (jqXhr){
				    
				        
				        if( jqXhr.status === 422 ) {
				        //process validation errors here.
				        $errors = jqXhr.responseJSON; //this will get the errors response data.
				        //show them somewhere in the markup
				        //e.g
				        errorsHtml = '<div class="alert alert-danger"><ul>';
				
				        $.each( $errors, function( key, value ) {
				            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
				        });
				        errorsHtml += '</ul></di>';
				       
				        $('#fileuploader').append(errorsHtml);
				        
				        } else {
				             errorsHtml = '<div class="alert alert-danger"> You are conducting an unauthorized action </div>';
				             $('#fileuploader').append(errorsHtml);
				        }
				    }
		      	});
		      	
		      	console.log('sent ajax');
			});
			
		});
	</script>
	
	<script>
		$(function(){
			$('#cashButton').click(function(){
				$.ajaxSetup({
		        	headers: {
		            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        	}
		    	});
				
				$.ajax({
					url:'{{URL::action("TransactionController@store")}}',
					type:'POST',
					data:{
						children:{!! $children !!},
			      		payment_method:'cash',
			      		program_season: {!! $program_season !!},
					},
					
					success: function(){
						$('#cashSuccess').show();
					}
				});	
			})
			
		});
	</script>
	
	<script>
		$(function(){
			$('#fundingButton').click(function(){
				$.ajaxSetup({
		        	headers: {
		            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        	}
		    	});
		    	
				$.ajax({
					url:'{{ URL::action("TransactionController@store")}}',
					type:'POST',
					data:{
						children:{!! $children !!},
			      		payment_method:'funding',
			      		program_season: {!! $program_season !!},
					},
					
					success: function (result){
						$('#fundingSuccess').show();
					},
				});	
			})
			
		});
	</script>
@endsection