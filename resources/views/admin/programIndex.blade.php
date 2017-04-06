@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="col-md-10 col-md-offset-1">
            @include('admin.backinclude')
        </div>
    <div class="row">
        
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>min age</th>
                            <th>max age</th>
                            <th>type</th>
                            <th>description</th>
                            <th>months since checkup</th>
                            <th></th>
                        </tr>
                        @foreach($programs as $program)
                        <tr>
                            <td>{{ $program->name }}</td>
                            <td>{{ $program->category }}</td>
                            <td>{{ $program->min_age }}</td>
                            <td>{{ $program->max_age }}</td>
                            <td>{{ $program->type }}</td>
                            <td class="long-description">{{ $program->description }}</td>
                            <td>{{ $program->months_since_checkup }}</td>
                            <td><a href="{{ URL::action('ProgramController@updateView',$program->id)}}"><button class="btn btn-primary">Edit</button></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

