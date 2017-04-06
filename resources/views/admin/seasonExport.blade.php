@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h1 class="text-center">Export Seasonal Data</h1>
			
			<div class="panel panel-default">
				<div class="panel-heading">Enter Information for Season to Export Data</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('SeasonController@exportSeasonData')}}">
                        {!! csrf_field() !!}
                        
                        <div class="form-group">
                          <label for="season" class="col-xs-12">Season:</label>
                          <div class="col-xs-12">
                              <select class="form-control " id="season" name="season">
                                <option value="Fall">Fall</option>
                                <option value="Winter">Winter</option>
                                <option value="Spring">Spring</option>
                                <option value="Summer">Summer</option>
                              </select>
                          </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }} ">
                          <label for="year" class="col-xs-12">Year:</label>
                            <div class="col-xs-12">
                              <input type="number" class="form-control" id="year" name="year" required>
                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-center">
                                    Export Data
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
			  @if( Session::has( 'warning' ))
  				   <p class="bg-danger text-center"> {{ Session::get( 'warning' ) }}</p>
			   @elseif(Session::has( 'success' ))
			   	   <p class="bg-success text-center"> {{ Session::get( 'success' ) }}</p>
         @endif
			</div>
		</div>
	</div>
</div>

@endsection
