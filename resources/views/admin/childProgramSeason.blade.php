@extends('layouts.app')


@section('content')
<div class="container">
  @include('admin.backinclude')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
			  <div class="panel-heading text-center">Registrants for {{$program_season->first()->program->name}} {{$program_season->first()->season->season}} {{$program_season->first()->season->year}}</div>
			  <div class="panel-body">
			    <table class="table">
               @if($cps->isEmpty())
              
                   No Regrstrants for this program at the moment.
               @else 

              <tr>
                  <th>Full Name</th>
                  <th>Status</th>
                  <th></th>
              </tr>
              
                  @foreach($cps as $cps_each)
                  <tr>
                      <td>{{ $cps_each->child->first_name }} {{ $cps_each->child->last_name }}</td>
                      <td>{{ ucfirst($cps_each->status)}}</td>
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
