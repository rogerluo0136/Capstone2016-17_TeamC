@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
      @include('admin.backinclude')
		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
			  <div class="panel-heading text-center">Update Information for {{$programSeason->program->name}} {{$programSeason->season->season}} {{$programSeason->season->year}}</div>
				<div class="panel-body">
					<form class="form-horizontal updatePanel" role="form"  action="{{ URL::action('ProgramSeasonController@update',$programSeason->id)}}">
                        {!! csrf_field() !!}
                  
                    <div class="form-group">
                      <label for="active" class="col-xs-12 col-md-2">Season</label>
                        <div class="col-xs-12 col-md-10">
                          <input class="form-control" id="disabledInput" name="season" placeholder="{{$programSeason->season->season}} {{$programSeason->season->year}}"
                          disabled>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                    <table class="table">

                    <tr>
                      <th align="center" style="width:20%">Program</th>
                      <th align="center" style="width:10%">Type</th>
                      <th align="center" style="width:13%">Cost</th>
                      <th align="center" style="width:15%">Spots Available</th>
                      <th align="center" style="width:12%">Status</th>
                      <th align="center" style="width:15%">Schedule (Day, Time)</th>
                      <th align="center" style="width:10%">Min Amount</th>
                    </tr>
                    
                    <tr>
                        
                        <td>{{$programSeason->program->name}}</td>
                        
                        <td>{{$programSeason->program->type}}</td>
                        
                        <td>                    
                          <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                            <input class="form-control" style="width:80%" type="number" id="cost" name="cost" value="{{$programSeason->cost}}"/>
                                  @if ($errors->has('cost'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('cost') }}</strong>
                                      </span>
                                  @endif
                          </div>
                        </td>
                        
                        <td>
                          <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                            <input class="form-control" style="width:90%" type="number" id="size" name="size" value="{{$programSeason->size}}"/>
                                  @if ($errors->has('size'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('size') }}</strong>
                                      </span>
                                  @endif
                          </div>
                        </td>
                        
                        <td>
                              <select class="form-control" id="status" name="status" value="{{$programSeason->status}}"/>
                                <option value="on" {{$programSeason->status=='on' ? 'selected' : ''}}>on</option>
                                <option value="off" {{$programSeason->status=='off' ? 'selected' : ''}}>off</option>
                              </select>
                        </td>
                        
                        <td>
                          <div class="form-group{{ $errors->has('schedule') ? ' has-error' : '' }}">
                                <input class="form-control" style="width:90%" type="text" id="schedule" name="schedule" value="{{$programSeason->schedule}}"/>
                                  @if ($errors->has('schedule'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('schedule') }}</strong>
                                      </span>
                                  @endif
                          </div>
                        </td>
                        
                        <td>
                          <div class="form-group{{ $errors->has('minimum_amount') ? ' has-error' : '' }}">
                                <input class="form-control" style="width:80%" type="number" id="minimum_amount" name="minimum_amount" value="{{$programSeason->minimum_amount}}"/>
                                  @if ($errors->has('minimum_amount'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('minimum_amount') }}</strong>
                                      </span>
                                  @endif
                          </div>
                        </td>
                        
                    </tr>    

                    </table>    
                    </div>
                    
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-center">
                                    Update Seasonal Program Info
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

@section('js')
<script src="{{ asset('js/update.js')}}"></script>
@endsection
