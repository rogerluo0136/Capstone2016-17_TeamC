


  <div class="row">
  	<div class="col-md-10 col-md-offset-1">
  		<div class="panel panel-default">
  	  	<div class="panel-heading" style="overflow:hidden">
         
  		  	<form><INPUT Type="button"  class="btn btn-primary pull-left"  VALUE="Back" onClick="history.go(-1);return true; "></form>
  		
  		  	<button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal">Cancel</button>
  		  </div>	
		  </div>
	  </div>
  
  </div>
 


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure?</h4>
        </div>
        <div class="modal-body">
          <p>All progress will be erased.</p>
        </div>
        <div class="modal-footer ">
        	
        		<a class="btn btn-primary center-block" role="button" href="{{url('/home')}}">Yes</a>
  
        </div>
      </div>
      
    </div>
  </div>
  



	       
