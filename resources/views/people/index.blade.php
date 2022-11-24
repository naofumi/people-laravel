@extends('layouts.application')
@section('title', 'People')

@section('content')

<h1>People</h1>
<div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($people as $person)
				<tr>
					<td>{{ $person->name }}</td>
					<td>{{ $person->email }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
