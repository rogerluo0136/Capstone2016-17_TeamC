@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        @include('admin.backinclude')
		<div class="col-md-8 col-md-offset-2">

			<h1 class="text-center">Program Information</h1>
			
			<div class="panel panel-default">
				<div class="panel-heading">Update Information for {{$program->name}}</div>
				<div class="panel-body">
					<form class="form-horizontal updatePanel" role="form" method="POST" action="{{ URL::action('ProgramController@update',$program->id)}}">
                        

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-xs-12">Program Name: <span class="text-danger">*</span></label>
                            <div class="col-xs-12">
                              <input type="text" class="form-control" id="name" name="name" value="{{$program->name}}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="active" class="col-xs-12">Program Category</label>
                            <div class="col-xs-12">
                              <select class="form-control" id="category" name="category">
                                <option value="Music"{{ $program->category=='Music' ? ' selected' : ''}}>Music</option>
                                <option value="Art"{{ $program->category=='Art' ? ' selected' : ''}}>Art</option>
                              </select>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('min_age') ? ' has-error' : '' }} ">
                          <label for="min_age" class="col-xs-12">Minimum Age:</label>
                            <div class="col-xs-12">
                              <input type="number" class="form-control" id="min_age" name="min_age" value="{{$program->min_age}}">
                                @if ($errors->has('min_age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('min_age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('max_age') ? ' has-error' : '' }} ">
                          <label for="max_age" class="col-xs-12">Maximum Age:</label>
                            <div class="col-xs-12">
                              <input type="number" class="form-control" id="max_age" name="max_age" value="{{$program->max_age}}">
                                @if ($errors->has('max_age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('max_age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="active" class="col-xs-12">Program Type</label>
                            <div class="col-xs-12">
                              <select class="form-control" id="type" name="type">
                                <option value="Group"{{ $program->type=='Group' ? ' selected' : ''}}>Group</option>
                                <option value="Individual"{{ $program->type=='Individual' ? ' selected' : ''}}>Individual</option>
                              </select>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('months_since_checkup') ? ' has-error' : '' }} ">
                          <label for="months_since_checkup" class="col-xs-12">Months until re-assessment required:</label>
                            <div class="col-xs-12">
                              <input type="number" class="form-control" id="months_since_checkup" name="months_since_checkup" value="{{$program->months_since_checkup}}">
                                @if ($errors->has('months_since_checkup'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('months_since_checkup') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          <label for="description" class="col-xs-12">Additional program description</label>
                            <div class="col-xs-12">
                              <textarea class="form-control" rows="3" id="description" name="description">{{$program->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-center">
                                    Update Program Info
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
