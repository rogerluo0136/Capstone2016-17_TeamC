@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<h1 class="text-center">Verify Information</h1>
		@include('admin.backinclude')
		<div class="col-md-10 col-md-offset-1">
			
			
			
			@include('child.update')
		
			<p>
				<b>
					Once you have revised and ensured all information is correct and verified, click the button below to return to admin home page.
				</b>
			</p>

		        <div class="form-group">
	                <div class="col-md-6 col-md-offset-4">
	                	<a href="{{URL::action('AdminController@index')}}">
	                    <button class="btn btn-primary pull-center">
	                        Verified Information
	                    </button>
	                    </a>
	                </div>
	            </div>
			</form>
			
		</div>
	</div>
</div>


@endsection

@section('js')
<script src="{{ asset('js/update.js') }}"></script>
@endsection