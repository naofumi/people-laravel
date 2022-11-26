@extends('layouts.application')
@section('title', 'People')

@section('content')

<div class="d-flex justify-content-between">
	<div>
		<a href="#"
		   class="btn btn-outline-secondary">
			Teams
		</a>
	</div>
	<h1>People</h1>
	<div>
		<a href="{{ route('people.create') }}"
		   class="btn btn-primary">
			New Person
		</a>
	</div>
</div>
<div data-controller="people-search">
	<div id="drill-down">
		<form action="{{ route('people.index') }}"
		      method="get">
		      <input id="searchbox"
		      		 type="text"
		      		 name="search"
		      		 placeholder="Search"
		      		 value="{{ request()->query('search') }}"
		      		 data-action="input->people-search#input">
		      <button type="submit">Search</button>
		</form>
	</div>
	<turbo-frame id="people_table" target="_top" data-people-search-target="turboframe">
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
	</turbo-frame>
</div>

{{-- <img src="{{ Vite::asset('resources/images/image.jpg') }}" /> --}}
@endsection
