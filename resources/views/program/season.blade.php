@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12">

			<h3>{{ strtoupper($program->name) }}</h3>
			<p>{{ $program->description }}
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>

		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-5 ">
			<h3>Program Details</h3>
			<table class="table">
				<tr>
					<th>Category</th>
					<th>Season</th>
					<th>Deadline</th>
					<th>Cost</th>
					<th>Type</th>
				</tr>
				<tr>
					<td>{{ $program->category}}</td>
					<td>{{ $season->season }}</td>
					<td>{{ $season->start }}</td>
					<td>{{ $program_season->cost}}</td>
					<td>{{ $program->type }}</td>

				</tr>
			</table>
		</div>
		<div class="col-xs-12 col-md-5 col-md-offset-2">

			<h3>Schedule</h3>
			<table class="table">
				<tr>
					<th>Day</th>
					<th>Start Time</th>
					<th>End Time</th>
				</tr>
				@foreach($program_season->schedules as $schedule)
				<tr>
					<td>{{ $schedule->day }}</td>
					<td>{{ $schedule->start_time }}</td>
					<td>{{ $schedule->end_time }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	<div class="row">
			<form class="form" role="form" method="POST" action="{{ URL::action('ChildController@verify')}}">
				{!! csrf_field() !!}
				<input type="hidden" name="program_season_id" value="{{$program_season->id}}">
				<h3>Child Selection</h3>
				<div class="form-group{{ $errors->has('mobility_support') ? ' has-error' : '' }}">
                    <label class="col-md-12 control-label">Select the child you would like to register to this program <span class="text-danger">*</span></label>


                    <div class="col-md-12">
                		@forelse(Auth::user()->childs as $child)
                			
                		<div class="checkbox">
						  <label>
						    <input type="checkbox" name="program_child[]" value="{{$child->id}}">
						    {{$child->name}}
						  </label>
						</div>

                		@empty
                		<p>
                			You still have no child registered under your account. Please head back to the home page
                			to do so.
                		</p>
                		@endforelse
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
@endsection