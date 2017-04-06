$(document).ready(function(){ 
	$('form.updatePanel').submit(function(event){
		event.preventDefault();
		//capture the form instance being submitted
		var form=$(this);

		$.ajaxSetup({
        	headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	}
    	});
		$.ajax({
			url: form.attr('action'),
			
			type:'PUT',
			data: form.serialize(),
			success:function(result){
				console.log("success");
				//prepare success message
				var successHtml= '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Information has been updated. <b><small>'+Date()+'</small></b></div>';

				//remove any prior messages on this form
		        form.find(".alert").remove();
				
				//display success message
				form.append(successHtml);
			},
			error: function(result){
				if( result.status === 401 ) //redirect if not authenticated user.
            		$( location ).prop( 'pathname', 'auth/login' );
				if( result.status === 422 ){
					
					//process validation errors here.
        			var errors = result.responseJSON; //this will get the errors response data.
        			//show them somewhere in the markup
        			//e.ge
        			$.each( errors , function( key, value ) {
			            console.log('key:'+key+' value:'+value); //showing only the first error.
			        });

        			var close ='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>';
        			var errorsHtml = '<div class="alert alert-danger">'+close+'<ul>';
        			
        			//loop through and store all the errors to be displayed
			        $.each( errors , function( key, value ) {
			            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
			        });

			        errorsHtml += '</ul></di>';
			        
			        //remove any prior messages on this form
			        form.find(".alert").remove();
			        //add the message to the end of the form
			        form.append(errorsHtml);
				}
			}
		});
  		
  		
	});
});



