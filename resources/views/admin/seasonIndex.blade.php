@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
         <div class="col-md-10 col-md-offset-1">
            @include('admin.backinclude')
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>All Seasons</h3>
                    <table class="table">
                        <tr>
                            <th>Year</th>
                            <th>Season</th>
                            <th>Active</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th></th>
                            <!--add more headers as required-->
                        </tr>
                        
                        @foreach($seasons as $season)
                        <tr>
                            <td>{{ $season->year}}</td>
                            <td>{{ $season->season }}</td>
                            <td>{{ $season->active}}</td>
                            <td>{{ $season->start }}</td>
                            <td>{{ $season->end }}</td>
                            <td>
                                <a href="{{ URL::action('SeasonController@show',[$season->id])}}">
                                    <button class="btn btn-default">View</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @if($seasons->isEmpty())
                    <p>No season has been created yet. click <a href="{{URL::action('SeasonController@create')}}">here</a> to start creating a season</p>
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>
    
    
    
    
   
</div>
@endsection

