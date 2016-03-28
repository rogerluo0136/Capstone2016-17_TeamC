@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrants waiting for approval to be invited for payment</div>
    
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Full Name</th>
                                <th>Program</th>
                            </tr>
                            
                            @if($cps->isEmpty())
                            
                            @else
                                @foreach($cps as $cps_each)
                                <tr>
                                    <td>{{ $cps_each->child->name }}</td>
                                    <td>{{ $cps_each->programSeason->program->name}}</td>
                                    <td><a href="{{URL::action('AdminController@childInfo',$cps_each->child->id)}}"><button class="btn btn-default">View Info</button></a></td>
                                </tr>
                                @endforeach
                            
                            @endif
                            
                            
                        </table>
    
                    </div>
                </div>
            </div>
                
                
            <div class="col-md-6 col-xs-12">
                <div class="panel panel-default">
                    @if($program_season->isEmpty())
                        <div class="panel-heading">No Active Upcoming Seasonal Programs</div>
                    @else
                        <div class="panel-heading">Upcoming {{$program_season->first()->season->name}} Program Stats</div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Program</th>
                                    <th># Inquired</th>
                                    <th># Invited</th>
                                    <th># Enrolled</th>
                                    <th>Max Size</th>
                                    <th>Status</th>
                                </tr>
                                
                                    @foreach($program_season as $program_each)
                                    <tr>
                                        <td>{{ $program_each->program->name }}</td>
                                        <td>{{ $program_each->childProgramSeason->where('status','like','inquired')->count() }}</td>
                                        <td>{{ $program_each->childProgramSeason->where('status','like','invited')->count() }}</td>
                                        <td>{{ $program_each->childProgramSeason->where('status','like','enrolled')->count() }}</td>
                                        <td>{{ $program_each->size }}</td>
                                        <td>{{ $program_each->status }}</td>
                                        <td><a href="{{URL::action('AdminController@programSeasonInfo',$program_each->id)}}"><button class="btn btn-default">View Info</button></a></td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>
                    @endif
                    
                </div>
            </div>
            
        </div>
    </div>
@endsection