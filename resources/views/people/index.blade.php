@extends('layouts.application')
@section('title', 'People')

@section('content')

<div class="d-flex justify-content-between">
	<div>
	</div>
	<h1>People</h1>
	<div>
		<a href="{{ route('people.create') }}"
		   class="btn btn-primary">
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
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($people as $person)
				<tr id="person_{{ $person->id }}">
					<td>
						{{ $person->name }}
					</td>
					<td>{{ $person->email }}</td>
					<td>
						<a href="{{ route('people.show', $person->id) }}"
						   class="btn btn-outline-secondary btn-sm">
							show
						</a>					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
{{-- <img src="{{ Vite::asset('resources/images/image.jpg') }}" /> --}}
@endsection
