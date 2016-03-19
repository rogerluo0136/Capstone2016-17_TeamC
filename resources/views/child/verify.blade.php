@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-md-8 col-md-offset-2">
			<h3>Verify Information</h3>
			<p> To continue please ensure that all children's information is up to date.</p>

			
			@foreach($childs as $child)
				@include('child.update')
			@endforeach

			<p>
				<b>
					Once you have revised and ensured all information is correct and verified, click the button below to continue 
					with your application
				</b>
			</p>
			<form role="form" method="POST" action="{{ URL::action('ChildProgramSeasonController@store',[$program_season->id]) }}">
				{!! csrf_field() !!}

				@foreach($childs as $child)
				<input type="hidden" name="program_child[]" value="{{ $child->id }}"/>
				@endforeach
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Verified Information</button>
				</div>
			</form>
			
		</div>
	</div>
</div>


@endsection

@section('js')
<script src="{{ asset('/js/update.js') }}"></script>
@endsection