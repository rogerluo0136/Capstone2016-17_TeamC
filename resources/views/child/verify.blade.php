@extends('layouts.app')

@section('css')
<style type="text/css">
.no-color{
	background-color:inherit;
	color: black;
	border-left: 2px solid #4989bd;
}
.p-color{
	color: white;
}
</style>
@endsection


@section('content')
<center>
    <h1>Program Registration </h1>
    <p class="p-color"> Verify information. To continue please ensure that all children's information is up to date.</p>
    </br>

</center>
<div class="container">
	
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="progress">
			  <div class="progress-bar progress-bar-active" style="width: 33%; min-width: 2em;">
			    Registrant & Program Selection
			  </div>
			  <div class="progress-bar progress-bar-active" style="width: 33%; min-width: 2em;">
			    Verification
			  </div>
			  <div class="progress-bar no-color" style="width: 34%; min-width: 2em;">
			    Finish
			  </div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >
				
					<b>
						<p style="color:black;">
						Once you have revised and ensured all information is correct and verified, click the button below to continue 
						with your application.
						</p>
					</b>

					
					<div class="row">
						<form role="form" method="POST" action="{{ URL::action('ChildProgramSeasonController@store',[$program_season->id]) }}">
							{!! csrf_field() !!}

							@foreach ($childs as $child)
							<input type="hidden" name="program_child[]" value="{{ $child->id }}"/>
							@endforeach

							<div class="form-group" >
								<button type="submit" class="btn btn-primary btn-lg center-block" >Verified, submit application</button>
							</div>

						</form>
					</div>

					<div class="row">
						<div class="col-md-12 ">
							<form><INPUT Type="button"  class="btn btn-primary pull-left"  VALUE="Back" onClick="history.go(-1);return true; "></form>
							<button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal">Cancel</button>
						</div>
					</div>
				
				</div>
			</div>

			
			@foreach($childs as $child)
				
				@include('child.update')
		</div>
		@endforeach
		
		
		<br>
		
		
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
  
@endsection

@section('js')
<script src="{{ asset('/js/update.js') }}"></script>
@endsection