@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-11 col-md-offset-1">

			<h1 class="text-center">Program Information by Season</h1>
			
			<div class="panel panel-default">
			  <div class="panel-heading">Enter Information for Programs to be added to {{$season->season}} {{$season->year}}</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/season/'.$season->id.'/programseason')}}">
                        {!! csrf_field() !!}
                  
                    <div class="table-responsive">
                    <table class="table">

                    <tr>
                      <th style="width:5%">Check</th>
                      <th align="center" style="width:20%">Program</th>
                      <th align="center" style="width:10%">Type</th>
                      <th align="center" style="width:13%">Cost</th>
                      <th align="center" style="width:15%">Spots Available</th>
                      <th align="center" style="width:12%">Status</th>
                      <th align="center" style="width:15%">Schedule (Day, Time)</th>
                      <th align="center" style="width:10%">Min Amount</th>
                    </tr>
                    
                    @foreach ($programs as $program)
                      @if( !App\ProgramSeason::where([['season_id',$season->id],['program_id',$program->id]])->exists())
                        <tr>
                            
                            <td>
                                <input type="checkbox" value="{{$program->id}}" name="program_id">
                            </td>
                            
                            <td>{{$program->name}}</td>
                            
                            <td>{{$program->type}}</td>
                            
                            <td>                    
                              <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                                <input class="form-control" style="width:80%" type="number" id="cost" name="cost" />
                                      @if ($errors->has('cost'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('cost') }}</strong>
                                          </span>
                                      @endif
                              </div>
                            </td>
                            
                            <td>
                              <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                                <input class="form-control" style="width:90%" type="number" id="size" name="size" />
                                      @if ($errors->has('size'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('size') }}</strong>
                                          </span>
                                      @endif
                              </div>
                            </td>
                            
                            <td>
                                  <select class="form-control" id="status" name="status" />
                                    <option value="on">on</option>
                                    <option value="off">off</option>
                                  </select>
                            </td>
                            
                            <td>
                              <div class="form-group{{ $errors->has('schedule') ? ' has-error' : '' }}">
                                    <input class="form-control" style="width:90%" type="text" id="schedule" name="schedule" />
                                      @if ($errors->has('schedule'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('schedule') }}</strong>
                                          </span>
                                      @endif
                              </div>
                            </td>
                            
                            <td>
                              <div class="form-group{{ $errors->has('minimum_amount') ? ' has-error' : '' }}">
                                    <input class="form-control" style="width:80%" type="number" id="minimum_amount" name="minimum_amount" />
                                      @if ($errors->has('minimum_amount'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('minimum_amount') }}</strong>
                                          </span>
                                      @endif
                              </div>
                            </td>
                            
                        </tr>
                      @endif
                    @endforeach
                    </table>    
                    </div>
                    
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-center">
                                    Add Seasonal Program Info
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
