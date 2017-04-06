@extends('layouts.form')

@section('content')
<center>
    <h1>View and Edit Your Child’s Information</h1>
    <p class="lead" style="width:50%">
        You may make any necessary changes to your child's information.
    </p>
</center>



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="overflow:hidden">
             
                    <a href="{{ url('/home') }}" Type="button"  class="btn btn-primary pull-left"   >Back</a>
        
                </div>    
              </div>
          </div>
    </div>

	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('child.update')
		</div>
	</div><!--row-->
</div><!--container-->
@endsection

@section('js')
<script src="{{ asset('/js/update.js') }}"></script>
@endsection

