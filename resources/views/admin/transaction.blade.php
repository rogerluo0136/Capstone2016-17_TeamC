@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-11 col-md-offset-1">
			<div class="panel panel-default">
			  <div class="panel-heading text-center">Choose the Program and Season to conduct transaction</div>
    			  <div class="panel-body">
    			      
    			      <form role="form" method="POST" action="{{URL::action('ProgramSeasonController@children')}}">
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
                            <label for="program" class="col-xs-12">Program:</label>
                              <div class="col-xs-12">
                                  <select class="form-control " id="program" name="program">
                                    @foreach(\App\Program::all() as $program) 
                                        <option value="{{$program->id}}">{{$program->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                          </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    Get Registrant List
                                </button>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
			  </div>
			</div>
		</div>
	</div>
</div>

@endsection
