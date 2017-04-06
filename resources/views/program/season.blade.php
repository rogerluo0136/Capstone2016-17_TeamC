@extends('layouts.app')

@section('css')
<style type="text/css">
.no-color{
	background-color:inherit;
	color: black;
	border-left: 2px solid #4989bd;
}
</style>
@endsection

@section('content')
<center>
    <h1>Program Registration</h1>
    </br>
    
</center>
<div class="container">

	<div class="row" >	
		<div class="col-md-6 col-md-offset-3">
			<div class="progress">
			  <div class="progress-bar progress-bar-active" style="width: 33%; min-width: 2em;">
			    Registrant & Program Selection
			  </div>
			  <div class="progress-bar no-color" style="width: 33%; min-width: 2em;">
			    Verification
			  </div>
			  <div class="progress-bar no-color" style="width: 33%; min-width: 2em;">
			    Finish
			  </div>
			</div>
		</div>
	
		</br>
	</div>


@include('child.createinclude')

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		
		<br>
			<div class="well">
				@if(is_null(Auth::user()->childs))
					<h4>All of your child(ren) have registered for assessment. Please contact John Taylor for futher information.</h4>
				@else
					<form class="form" role="form" method="GET" action="{{ URL::action('ChildController@verify')}}">
						{!! csrf_field() !!}
						<input type="hidden" name="program_season_id" value="{{$program_season->id}}">
						<div class="row">
							<div class="form-group{{ $errors->has('program_child') ? ' has-error' : '' }}">
		                    	<label class="col-md-12 control-label">Select the child you would like to register to this program: <span class="text-danger">*</span></label>

		                    	<div class="col-md-12">
		                    		<?php $flag=false; ?>
			                		@forelse($children as $child)
			                			 @if($child->dob->age>=$program->min_age && $child->dob->age<=$program->max_age)
					                		<div class="checkbox">
											  <label>
											    <h3><input type="checkbox" name="program_child[]" value="{{$child->id}}">
											    {{$child->first_name}} {{$child->last_name}}</h3>
											  </label>
											</div>
											<?php $flag=true; ?>
										@endif
			                		@empty
			                		<p>
			                			You still have no child registered under your account or have registered all your children to this program already.
			                			To register a new child please go back to the <a href="{{url('/home')}}"><b>home</b></a> page.
			                		</p>
			                		@endforelse
			                		
			                		@if(!$flag)
			                		<p>
			                			You have no unregistered children under your account that meet the age requirements of the program.
			                			Click <a href="{{url('/home')}}"><b>here</b></a> to go back to the home page.
			                		</p>
			                		@endif
			                	</div>
		                	</div>
							
						</div>
						</br>
					
						<div class="panel panel-default">
							<div class="panel-heading">
								{{ strtoupper($program->name) }}
							</div>
							<div class="panel-body">
								<p>{{ $program->description }}</p>
								
								<table class="table">
									<tr>
										<th>Category</th>
										<th>Season</th>
										<th>Start Date</th>
										<th>Cost</th>
										<th>min age</th>
										<th>max age</th>
										<th>Type</th>
									</tr>
									<tr>
										<td>{{ $program->category}}</td>
										<td>{{ $season->season }}</td>
										<td>{{ $season->start->toFormattedDateString() }}</td>
										<td>{{ $program_season->cost }}</td>
										<td>{{ $program->min_age }}</td>
										<td>{{ $program->max_age }}</td>
										<td>{{ $program->type }}</td>

									</tr>
								</table>

							</div>
						</div>

						@if(!is_null(Auth::user()->childs))
		                <div class="form-group">
		                	<div class="row">
			                <div class="col-md-12">
			                    <button type="submit" class="btn btn-primary pull-right">
			                        Continue
			                    </button>
			                </div>
			            	</div>
			            </div>
		                @endif
						
					</form>
				@endif
			</div>
		</div>
	</div>
		
	
</div>

</div>
@endsection