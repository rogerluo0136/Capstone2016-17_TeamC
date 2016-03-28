@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h1 class="text-center">Season Information</h1>
			
			<div class="panel panel-default">
				<div class="panel-heading">Enter Information for New Season</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('SeasonController@store')}}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                          <label for="season" class="col-xs-12">Select season name:</label>
                          <div class="col-xs-12">
                              <select class="form-control " id="season" name="season">
                                <option>Fall</option>
                                <option>Winter</option>
                                <option>Spring</option>
                                <option>Summer</option>
                              </select>
                          </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }} ">
                          <label for="year" class="col-xs-12">Year:</label>
                            <div class="col-xs-12">
                              <input type="number" class="form-control" id="year" name="year">
                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
                            <label class="col-xs-12">Season Start Date <span class="text-danger">*</span></label>

                            <div class="col-xs-12">
                                <input type="date" class="form-control" name="start" value="{{ old('start') }}" required>

                                @if ($errors->has('start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('end') ? ' has-error' : '' }}">
                            <label class="col-xs-12">Season End Date <span class="text-danger">*</span></label>

                            <div class="col-xs-12">
                                <input type="date" class="form-control" name="end" value="{{ old('end') }}" required>

                                @if ($errors->has('end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('weeks') ? ' has-error' : '' }}">
                          <label for="weeks" class="col-xs-12">Number of Weeks:</label>
                            <div class="col-xs-12">
                              <input type="number" class="form-control" id="weeks" name="weeks">
                                @if ($errors->has('weeks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weeks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="active" class="col-xs-12">Is season active (open for registrations)?</label>
                            <div class="col-xs-12">
                              <select class="form-control" id="active" name="active">
                                <option>Yes</option>
                                <option>No</option>
                              </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-center">
                                    Add Season Info
                                </button>
                            </div>
                        </div>



                    </form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
