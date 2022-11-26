@extends('layouts.application')
@section('title', 'Edit Person')

@section('content')

<div class="d-flex justify-content-between">
	<div>
		<a href="{{ route('people.show', $person) }}"
		   class="btn btn-outline-secondary">
			Back
		</a>
	</div>
	<h1>Edit Person</h1>
	<div>
		<button form="person"
				type="submit"
				value="Update Person"
				class="btn btn-warning">
			Update Person
		</button>
	</div>
</div>
@include('shared.errors')
<form id="person"
	  action="{{ route('people.update', $person) }}"
	  method="post">
	@csrf
	@method('PATCH')
	<div>
		<label for="name">Name</label>
		<input type="text"
			   name="name"
			   value={{ old('name', $person->name) }}>
	</div>
	<div>
		<label for="email">Email</label>
		<input type="text"
			   name="email"
			   value={{ old('email', $person->email) }}>
	</div>
</form>
<div class="d-flex justify-content-between mt-5">
	<div></div>
	<form action="{{ route('people.destroy', $person) }}" method="post" data-turbo-confirm="Are you sure you want to delete this person">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger">Delete Person</button>
	</form>
</div>
@endsection
