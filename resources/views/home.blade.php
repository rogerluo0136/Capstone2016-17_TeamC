@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>Hello, {{ $user->name }}!</h1>
        <p>
            Welcome to your parent portal. You can add your children&#39;s information, register to courses, and conduct 
            payments all from one place
        </p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
    </div>


    <div class="row">
        <div class="col-md-6 col-xs-12">
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
                            <td><a><button class="btn btn-default">View Info</button></a></td>
                            <td><a><button class="btn btn-primary">List Courses</button></a></td>
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
                                            <td>{{ $season->start }}</td>
                                            <td><a href="{{ URL::action('ProgramSeasonController@show',[$program->id,$season->id]) }}"><button class="btn btn-primary">Apply</button></a></td>
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
