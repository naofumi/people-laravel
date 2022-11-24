@extends('layouts.application')
@section('title', 'People')

@section('content')

<div class="d-flex justify-content-between">
	<h1>People</h1>
	<div>
		<a href="{{ route('people.create') }}" class="btn btn-primary">
			New Person
		</a>
	</div>
</div>
<div id="people">
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($people as $person)
				<tr id="person_{{ $person->id }}">
					<td>
						<a href="{{ route('people.show', $person->id) }}">
							{{ $person->name }}
						</a>
					</td>
					<td>{{ $person->email }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
