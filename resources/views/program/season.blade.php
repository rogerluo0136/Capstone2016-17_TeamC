@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default padder">
	<div class="row">
		<div class="col-xs-12">
			

			<h3 class="text-center">{{ strtoupper($program->name) }}</h3>
			<p>{{ $program->description }}</p>

		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 ">
			<h3>Program Details</h3>
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
	<div class="row">
		<div class="col-xs-12 ">
			<form class="form" role="form" method="POST" action="{{ URL::action('ChildController@verify')}}">
				{!! csrf_field() !!}
				<input type="hidden" name="program_season_id" value="{{$program_season->id}}">
				<h3>Child Selection</h3>
				<div class="form-group{{ $errors->has('mobility_support') ? ' has-error' : '' }}">
                    <label class="col-md-12 control-label">Select the child you would like to register to this program <span class="text-danger">*</span></label>


                    <div class="col-md-12">
                    	<?php $flag=false; ?>
                		@forelse($children as $child)
                			 @if($child->dob->age>=$program->min_age && $child->dob->age<=$program->max_age)
		                		<div class="checkbox">
								  <label>
								    <input type="checkbox" name="program_child[]" value="{{$child->id}}">
								    {{$child->name}}
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

                @if(!is_null(Auth::user()->childs))
                <div class="form-group">
	                <div class="col-md-6">
	                    <button type="submit" class="btn btn-primary">
	                        Continue
	                    </button>
	                </div>
	            </div>
                @endif
                        
			</form>
			</div>
		</div>
	</div>
	
</div>

</div>
@endsection