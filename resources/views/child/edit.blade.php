@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-md-8 col-md-offset-2">
			<h3>View and Edit Child Information</h3>
			<p> You may make any necessary changes to your child's information</p>

			@include('child.update')
			
			<p>
				<b>
					Once you have revised and ensured all information is correct and verified, click the button below to return to the home page.
				</b>
			</p>
			<a href="{{url('/home')}}"><button class="btn btn-primary">Main Page</button></a>
		</div>
	</div>
</div>


@endsection

@section('js')
<script src="{{ asset('/js/update.js') }}"></script>
@endsection