@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1 class="text-center">View All Registrants</h1>
    

    @include('admin.backinclude')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
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
                                    <td>{{ $cps_each->child->first_name }} {{ $cps_each->child->last_name }}</td>
                                    <td>{{ $cps_each->programSeason->program->name}}</td>
                                    <td><a href="{{URL::action('AdminController@childInfo',$cps_each->id)}}"><button class="btn btn-default">View Info</button></a></td>
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

