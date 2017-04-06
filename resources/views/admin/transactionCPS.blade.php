@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-11 col-md-offset-1">
			<div class="panel panel-default">
			  <div class="panel-heading text-center">Choose the Registrant to conduct transaction</div>
    			  <div class="panel-body">
    			      
    			      @if($cps->isEmpty())
    			          There are no registrants under the selected program.
  			        @else
  			            <div class="list-group">
  			            @foreach($cps as $cps_each)
            			      <a href="{{URL::action('AdminController@index')}}">
    	                    <button type="button" class="list-group-item">{{$cps_each->child->name}}</button>
  	                    </a>
                      @endforeach
                  @endif
                </div>
			  </div>
			</div>
		</div>
	</div>
</div>

@endsection
