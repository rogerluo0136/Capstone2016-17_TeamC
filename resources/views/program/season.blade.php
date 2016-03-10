@extends('layouts.app')

@section('content')
<div class="container">
	<h3>{{ strtoupper($program->name) }}</h3>
	<p>{{ $program->description }}</p>

	<h3>SCHEDULE</h3>
	<table>
		<tr>
			<th>Day</th>
			<th>Start Time</th>
			<th>End Time</th>
		</tr>
		@foreach($program_season->schedules as $schedule)
		<tr>
			<td>{{ $schedule->day }}</td>
			<td>{{ $schedule->start_time }}</td>
			<td>{{ $schedule->end_time }}</td>
		</tr>
		@endforeach
	</table>

	
</div>
@endsection