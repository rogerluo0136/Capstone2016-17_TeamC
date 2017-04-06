@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Welcome, Admin</h1>
            <br>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>1. Programs has to be created first in order to be added into seasons.</p>
                        <p>2. Create a season and add programs to it.</p>
                        <p>3. Multiple seasons can be created and managed separately.</p>
                        <p>4. Update status of registrants to allow payment and confirm registration.</p>
                        <p>5. Season infomation can be exported to an excel file through the dropdown menu at the top.</p>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row"> 
           
            <div class="col-md-5 col-xs-12">

                <div class="panel panel-default">
                     <div class="panel-heading text-center">
                        Programs
                     </div>
                     <div class="panel-body">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="{{ URL::action('ProgramController@index') }}" class="btn btn-primary" role="button">View All</a>
                            <a href="{{ URL::action('ProgramController@create') }}" class="btn btn-primary" role="button">Add New</a>
                        </div>
                     </div>
                </div>
          
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Registrants waiting for approval to be Invited</div>
    
                    <div class="panel-body">
                        <table class="table">
                            @if($cps->isEmpty())
                                No Registrants awaiting at the moment. 
                            @else
                            <tr>
                                <th>Full Name</th>
                                <th>Program</th>
                            </tr>
                            
                                @foreach($cps as $cps_each)
                                <tr>
                                    <td>{{ $cps_each->child->first_name }} {{ $cps_each->child->last_name }}</td>
                                    <td>{{ $cps_each->programSeason->program->name}}</td>
                                    <td><a href="{{URL::action('AdminController@childInfo',$cps_each->id)}}"><button class="btn btn-default">View Info</button></a></td>
                                </tr>
                                @endforeach
                            
                            @endif
                            
                            
                        </table>
                        <div class="col-md-4 col-md-offset-4">
                             <a href="{{URL::action('AdminController@viewAllRegistrants')}}" class="btn btn-primary center-block" role="button">View All</a>
                        </div>
                       
                       
                    </div>
                </div>
            </div>
                
                
            <div class="col-md-7 col-xs-12">
                <div class="panel panel-default">
                    
                       
                  
                        <div class="panel-heading text-center">Upcoming Seasons Stats {{$program_season->first()->season->season}} {{$program_season->first()->season->year}}</div>
                        <div class="panel-body">
                            <table class="table">
                                @if($program_season->isEmpty())
                                    No Upcoming Active Seasons at the moment.
                                @else
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
                                        <td>{{ $program_each->childProgramSeason()->where('status','like','inquired')->count() }}</td>
                                        <td>{{ $program_each->childProgramSeason()->where('status','like','invited')->count() }}</td>
                                        <td>{{ $program_each->childProgramSeason()->where('status','like','enrolled')->count() }}</td>
                                        <td>{{ $program_each->size }}</td>
                                        <td>{{ $program_each->status }}</td>
                                        <td><a href="{{URL::action('AdminController@programSeasonInfo',$program_each->id)}}"><button class="btn btn-default">View Registrants</button></a></td>
                                    </tr>
                                    @endforeach

                                  @endif
                            </table>
                        </div>
                  
                    
                </div>
            </div>
        </div>     
        
    </div>
@endsection