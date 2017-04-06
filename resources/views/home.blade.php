@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="jumbotron">
        <h1>Welcome, {{ $user->username }}!</h1>
        <p>
            You can add your children&#39;s information, register to courses, and conduct 
            payments all from one place.
        </p>
    </div>


    <div class="row">
        <div class="col-md-6 col-xs-12">

            <!-- Current Registration Table -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Current Registrations</div>
                        <div class="panel-body">
                            <table class="table">
                                
                                @if(is_null($cps_collection->first()))
                                    <p>You don't have any current registrations yet.</p>

                                @else
                               
                                <tr>
                                    <th>Child</th>
                                    <th>Program</th>
                                    <th>Season</th>
                                    <th>Enrollment Status</th>
                                </tr>       
                                    @foreach($cps_collection as $cps)
                                    <tr>

                                        <td>{{$cps->child->first_name}}</td>
                                        @if($cps->program_season_id != 0)
                                            <td>{{$cps->programSeason->program->name}}</td>
                                            <td>{{$cps->programSeason->season->season}} {{$cps->programSeason->season->year}}</td>
                                            <!-- <td>{{ucfirst($cps->status)}}</td> -->
                                            <td>
                                            <?php if ($cps->status == 'inquired'){
                                                echo "Submitted";
                                            }elseif ($cps->status == 'invited') {
                                                echo "Accepted";
                                            }else{
                                                echo "Enrolled";
                                            }
                                            ?>
                                            </td>
                                        @else
                                            <td>Music Assessment</td>
                                            <td>N/A</td>
                                            <td>{{ucfirst($cps->status)}}</td>
                                        @endif
                                        
                                    </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Programs Table -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Available Programs</div>

                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Program Name</th>
                                    <th>Category</th>
                                    <th>Start Date</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>

                                
                                @foreach($seasons as $season)
                                    @foreach($season->programs as $program)
                                        @if( App\ProgramSeason::where([['season_id',$season->id],['program_id',$program->id],['status','on']])->exists())
                                            
                                        <tr>
                                            <td>{{ $program->name }}</td>
                                            <td>{{ $program->category }}</td>
                                            <td>{{ $season->start->toFormattedDateString() }}</td>
                                            <td>
                                            @foreach($season->program_seasons as $programSeason)
                                                @if($programSeason->season_id==$season->id && $programSeason->program_id ==$program->id)
                                                    $ {{ $programSeason->cost }}
                                                @endif
                                            @endforeach
                                            </td>
                                            <td><a href="{{ URL::action('ProgramSeasonController@register',[$program->id,$season->id]) }}"><button class="btn btn-primary pull-right">Apply</button></a></td>
                                        </tr>
                                        @endif
                            
                                    @endforeach 
                                @endforeach
                            </table>
                            <a href="{{ url('/allprograms') }} " class="btn btn-success center-block" style="width: 60%"><i class="glyphicon glyphicon-duplicate"></i> View All Available Programs/Register</a>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="col-md-6 col-xs-12">
            <!-- Outstanding Balance Table -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Outstanding Balance</div>
                        
                        <div class="panel-body">

                            <center>
                            <?php $balance=0.00;?>
                            @foreach($cps_collection as $cps)
                                @if($cps->program_season_id == 0)
                                    @if($cps->status != 'enrolled')
                                        <?php $balance = $balance + 80 - $cps->transactions()->sum('amount'); ?>
                                    @endif
                                @elseif($cps->status=='invited')
                                    <?php $balance = $balance + $cps->programSeason->cost  - $cps->transactions()->sum('amount'); ?>
                                @endif
                            @endforeach
                            <h2><b>$ {{$balance}} </b></h2>
                            </center>
                            <table class="table">
                                <table class="table">

                                 
                                <tr>
                                    <th>Child</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                                    
                                    @foreach($cps_collection as $cps)
                                    <tr>
                                        <td>{{$cps->child->first_name}}</td>
                                        @if($cps->program_season_id == 0)
                                            @if($cps->status != 'enrolled')
                                                <td>Music Assessment</td>
                                                <td>Awaiting Payment</td>
                                                <td>$ 80</td>
                                                <td><a href="{{URL::action('TransactionController@balance',[$cps->id])}}"><button class="btn btn-primary">Pay Fees</button></a></td>
                                            @endif
                                        @elseif($cps->status=='invited')
                                            <td>{{$cps->programSeason->program->name}}</td>
                                            <td>Awaiting Payment</td>
                                            <td>${{$cps->programSeason->cost  - $cps->transactions()->sum('amount')}}</td>

                                            <td><a href="{{URL::action('TransactionController@balance',[$cps->id])}}"><button class="btn btn-primary">Pay Fees</button></a></td>
                                            
                                        @elseif($cps->status=='inquired')
                                            <td>{{$cps->programSeason->program->name}}</td>
                                            <td>Awaiting Assessment</td>
                                            <td>N/A</td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    @endforeach
                              
                            </table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Your Children Table -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="overflow:hidden;">
                            Your Children

                            <a href="{{ URL::action('UserChildController@create',[$user->username])}}">
                                <button class="btn btn-primary pull-right">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    Add Child
                                </button>
                            </a>
                           

                        </div>
                     
                        <div class="panel-body">
                            <table class="table">
                                
                            @if(is_null($user->childs->first()))
                                <p>You haven't added any child information yet.</p>
                            @else   
                                <tr>
                                    <th>Name</th>
                                    <th></th>
                                   
                                </tr>
                                @foreach($user->childs as $child)
                                <tr>
                                    <td>{{ $child->first_name }} {{ $child->last_name }}</td>
                                    <td><a href="{{ URL::action('UserChildController@edit',[Auth::user()->id,$child->id]) }}"><button class="btn btn-primary pull-right">View/Edit Info</button></a></td>
                                </tr>
                                
                                @endforeach

                            @endif
                            </table>
                        </div>
                      
                        <br>
                        <!-- <a style="width: 60%" href="#" class="btn btn-success center-block"><i class="glyphicon glyphicon-user"></i> View Personal Account and Child Information</a>
                        <br> -->

                    </div>
                </div>
            </div>

            
            
        </div>
    </div>
</div>
@endsection
