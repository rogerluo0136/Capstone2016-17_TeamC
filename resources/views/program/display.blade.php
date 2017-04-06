@extends('layouts.app')

@section('content')
<center >
	@if($category == 'music')
		<h1>Music Program Registration</h1>
	    <p class="lead" style="width:80%; color:white;">
	        FALL: Sep10–Dec18(12wks+MU)</br> 
			WINTER: Jan14–Mar26(7wks+MU)</br> 
			SPRING: Apr8–Jun25(8wks+MU)</br> 
			Each season includes an extra week for make-up (MU) sessions.</br> 
	    </p>
	@elseif($category == 'art')
		<h1>Arts Program Registration</h1>
	    <p class="lead" style="width:80%; color:white">
	    	Art programs are offered in a group format of approximately 8-12 participants, and are open to participants’ siblings.</br>
	        FALL: Sep10–Dec18(12wks+MU)</br> 
			WINTER: Jan14–Mar26(7wks+MU)</br> 
			SPRING: Apr8–Jun25(8wks+MU)</br> 
			Each season includes an extra week for make-up (MU) sessions.</br> 
	    </p>
	@else
		<h1>All Music & Arts Program Registration</h1>
	    <p class="lead" style="width:80%; color:white">
	    	Combining the unique skillset of the musician and the artist to offer participating families a complete hands-on creative experience with varying themes.</br>
	        Please choose your favorite porgram to register.
	    </p>
	@endif
</center>

<div class="container">
@include('child.createinclude')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<!--Music-->
			@if($category!='art')
			<div class="panel panel-default">
				<div class="panel-heading">Music Programs</div>
				
				<div class="panel-body">
				@if(App\Program::where([['category','Music']])->exists())
					<table class="table">
                        <tr>
                            <th>Program Name</th>
                            <th>Ages</th>
                            <th>Season</th>
                            <th>Time/Day</th>
                            <th>Price</th>
                            <th></th>
                        </tr>

                        
                        @foreach($seasons as $season)
                            @foreach($season->programs as $program)

                                @if($program->category == 'Music' && App\ProgramSeason::where([['season_id',$season->id],['program_id',$program->id],['status','on']])->exists())
                                    
                                <tr>
                                    <td>{{ $program->name }}</td>
                                    <td>{{ $program->min_age}} ~ {{ $program->max_age }} yrs old</td>
                                    <td>{{ $season->season}}</td>
                                    @foreach($season->program_seasons as $programSeason)
                                        @if($programSeason->season_id==$season->id && $programSeason->program_id ==$program->id)
                                            <td>{{ $programSeason->schedule }}</td>
                                            <td>$ {{ $programSeason->cost}} </td>
                                        @endif
                                    @endforeach
                                    
                                    <td><a href="{{ URL::action('ProgramSeasonController@register',[$program->id,$season->id]) }}"><button class="btn btn-primary pull-right">Apply</button></a></td>
                                </tr>
                                @elseif(!App\ProgramSeason::where([['season_id',$season->id],['program_id',$program->id],['status','on']])->exists())
		                			<h4>No Music Program Available Currently.</h4>
                                @endif
                    
                            @endforeach 
                        @endforeach
                    </table>
                    @else
		                	<h4>No Music Program Available Currently.</h4>
                    @endif
				</div><!--panel-body-->
			</div><!--panel-->
			@endif

			<!--Art-->
			@if($category != 'music')
				
				<div class="panel panel-default">
					<div class="panel-heading">Arts Programs</div>
					
					<div class="panel-body">
						@if(App\Program::where([['category','Arts']])->exists())
							<table class="table">
		                        <tr>
		                            <th>Program Name</th>
		                            <th>Ages</th>
		                            <th>Season</th>
		                            <th>Time/Day</th>
		                            <th>Price</th>
		                            <th></th>
		                        </tr>

		                        
		                        @foreach($seasons as $season)
		                            @foreach($season->programs as $program)

		                                @if($program->category == 'Arts' && App\ProgramSeason::where([['season_id',$season->id],['program_id',$program->id],['status','on']])->exists())
		                                    
		                                <tr>
		                                    <td>{{ $program->name }}</td>
		                                    <td>{{ $program->min_age}} ~ {{ $program->max_age }} yrs old</td>
		                                    <td>{{ $season->season}}</td>
		                                    @foreach($season->program_seasons as $programSeason)
		                                        @if($programSeason->season_id==$season->id && $programSeason->program_id ==$program->id)
		                                            <td>{{ $programSeason->schedule }}</td>
		                                            <td>$ {{ $programSeason->cost}} </td>
		                                        @endif
		                                    @endforeach
		                                    
		                                    <td><a href="{{ URL::action('ProgramSeasonController@register',[$program->id,$season->id]) }}"><button class="btn btn-primary pull-right">Apply</button></a></td>
		                                </tr>
		                                @elseif(!App\ProgramSeason::where([['season_id',$season->id],['program_id',$program->id],['status','on']])->exists())
		                                	<h4>No Arts Program Available Currently.</h4>
		                                @endif
		                    
		                            @endforeach 
		                        @endforeach
		                    </table>
		                @else
		                	<h4>No Arts Program Available Currently.</h4>
		                @endif
					</div><!--panel-body-->
				</div><!--panel-->
				
			@endif

		</div><!--col-->
	</div><!--row-->
</div><!--container-->


@endsection