@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
             
                @include('admin.backinclude')
            
            <div class="col-md-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Season Info</div>
                    <div class="panel-body">
                        <form class="form-horizontal updatePanel"  action="{{URL::action('SeasonController@update',[$season->id])}}">
                            
                            <div class="form-group{{ $errors->has('season') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Season <span class="text-danger">*</span></label>
                                
                                <div class="col-md-6">
                                    
                                    <select class="form-control" name="season">
                                      <option value="Fall" {{$season->season=='Fall' ? 'selected' : ''}}>Fall</option>
                                      <option value="Winter" {{$season->season=='Winter' ? 'selected' : ''}}>Winter</option>
                                      <option value="Spring" {{$season->season=='Spring' ? 'selected' : ''}}>Spring</option>
                                      <option value="Summer" {{$season->season=='Summer' ? 'selected' : ''}}>Summer</option>
                                    </select>
                                    
                                    @if ($errors->has('season'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('season') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Year <span class="text-danger">*</span></label>
                                
                                <div class="col-md-6">
                                    <input type="number" placeholder="2016" class="form-control" name="year" value="{{$season->year }}">
    
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Start Date <span class="text-danger">*</span></label>
                                
                                <div class="col-md-6">
                                    <input type="date"  class="form-control" name="start" value="{{ $season->start->toDateString() }}">
    
                                    @if ($errors->has('start'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('end') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">End Date <span class="text-danger">*</span></label>
                                
                                <div class="col-md-6">
                                    <input type="date"  class="form-control" name="end" value="{{ $season->end->toDateString() }}">
    
                                    @if ($errors->has('end'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('weeks') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Weeks <span class="text-danger">*</span></label>
                                
                                <div class="col-md-6">
                                    <input type="number"  class="form-control" name="weeks" value="{{ $season->weeks }}">
    
                                    @if ($errors->has('weeks'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('weeks') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Active <span class="text-danger">*</span></label>
                                
                                <div class="col-md-6">
                                    
                                    <select class="form-control" name="active">
                                      <option value="Yes" {{$season->season=='Yes' ? 'selected' : ''}}>Yes</option>
                                      <option value="No" {{$season->season=='No' ? 'selected' : ''}}>No</option>
                                    </select>
                                    
                                    @if ($errors->has('active'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('active') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        Update Season
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            
            
            
            <div class="col-md-8 col-xs-12">
                <div class="panel panel-default" style="overflow:hidden;">
                    <div class="panel-heading">
                        Season Programs 
                        <a href="{{URL::action('ProgramSeasonController@addProgramSeason', [$season->id])}}" role="button" class="btn btn-primary pull-right" >add/remove programs</a></div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Program</th>
                                <th># inquired</th>
                                <th># invited</th>
                                <th># enrolled</th>
                                <th>Program Size</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                            
                            @foreach($program_season as $program_each)
                            <tr>
                                <td>{{ $program_each->program->name }}</td>
                                <td>{{ $program_each->childProgramSeason()->where('status','like','inquired')->count() }}</td>
                                <td>{{ $program_each->childProgramSeason()->where('status','like','invited')->count() }}</td>
                                <td>{{ $program_each->childProgramSeason()->where('status','like','enrolled')->count() }}</td>
                                <td>{{ $program_each->size }}</td>
                                <td>{{ $program_each->status }}</td>
                                <td><a href="{{URL::action('AdminController@programSeasonInfo',$program_each->id)}}"><button class="btn btn-default">Registrants</button></a></td>
                                <td><a href="{{ URL::action('ProgramSeasonController@show',$program_each->id) }}"><button class="btn btn-primary">Update</button></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/update.js')}}"></script>
@endsection