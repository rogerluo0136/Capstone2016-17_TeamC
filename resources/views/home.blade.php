@extends('layouts.app')



@section('content')
<div class="container">
    
    <div class="jumbotron">
        <h1>Hello, {{ $user->name }}!</h1>
        <p>
            You can add your children&#39;s information, register to courses, and conduct 
            payments all from one place
        </p>
    </div>


    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Your Children</div>
        
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Full Name</th>
                                </tr>
                                @foreach($user->childs as $child)
                                <tr>
                                    <td>{{ $child->name }}</td>
                                    <td><a href="{{URL::action('UserChildController@edit',[Auth::user()->id,$child->id])}}"><button class="btn btn-default">View Info</button></a></td>
        
                                </tr>
                                
                                @endforeach
                            </table>
        
                            <a href="{{ URL::action('UserChildController@create',[$user->id])}}">
                                <button class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    Add Child
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Curret Registrations</div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Child</th>
                                    <th>Program</th>
                                    <th>Enrollment Status</th>
                                    <th>Unsettled Balance</th>
                                    
                                </tr>
                                
                                    
                                    @foreach($cps_collection as $cps)
                                    <tr>
                                        <td>{{$cps->child->name}}</td>
                                        
                                        <td>{{$cps->programSeason->program->name}}</td>
                                        @if($cps->status=='invited')
                                        <td>Awaiting Payment</td>
                                            @if($cps->payment_method=='Option 4')
                                                <td>N/A (Funding)</td>
                                            @else
                                                <td>{{$cps->programSeason->cost  - $cps->transactions()->sum('amount')}}</td>
                                                <td><a href="{{URL::action('TransactionController@balance',[$cps->id])}}"><button class="btn btn-primary">Pay Balance</button></a></td>
                                            @endif
                                        @elseif($cps->status=='inquired')
                                        <td>Awaiting Assessment</td>
                                        <td>N/A</td>
                                        @elseif($cps->status=='enrolled')
                                        <td>Enrolled</td>
                                        <td>{{ $cps->transactions()->sum('amount') >= $cps->programSeason->cost ? 0 : $cps->programSeason->cost - $cps->transactions()->sum('amount')}}</td>
                                        <td><a href="{{URL::action('TransactionController@balance',[$cps->id])}}"><button class="btn btn-primary">Pay Balance</button></a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Available Programs</div>

                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Program</th>
                                    <th>Season</th>
                                    <th>Deadline</th>
                                </tr>

                                
                                @foreach($seasons as $season)
                                    @foreach($season->programs as $program)
                                        <tr>
                                            <td>{{ $program->name }}</td>
                                            <td>{{ $season->season }}</td>
                                            <td>{{ $season->start->toFormattedDateString() }}</td>
                                            <td><a href="{{ URL::action('ProgramSeasonController@register',[$program->id,$season->id]) }}"><button class="btn btn-primary">Apply</button></a></td>
                                        </tr>
                                    @endforeach 
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
@endsection
