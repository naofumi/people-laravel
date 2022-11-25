@extends('layouts.application')
@section('title', 'Edit Person')

@section('content')

<div class="d-flex justify-content-between">
	<h1>Edit Person</h1>
	<div>
		<a href="{{ route('people.show', $person) }}" class="btn btn-primary">
			Show Person
		</a>
	</div>
</div>
<form action="{{ route('people.edit', $person) }}" method="post">
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
	<div class="mt-3">
	    <input type="submit" value="Update Person" class="btn btn-primary">
	</div>
</form>
<div class="d-flex justify-content-between">
	<div></div>
	<form action="{{ route('people.destroy', $person) }}" method="post" data-turbo-confirm="Are you sure you want to delete this person">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger">Delete Person</button>
	</form>
</div>
@endsection
