@extends('layouts.application')
@section('title', 'Create Person')

@section('content')

<div class="d-flex justify-content-between">
	<h1>Create Person</h1>
	<div>
		<a href="{{ route('people.index') }}" class="btn btn-primary">
			List of People
		</a>
	</div>
</div>
<form action="{{ route('people.store') }}" method="post">
	@csrf
	<div>
		<label for="name">Name</label>
		<input type="text"
			   name="name"
			   value={{ old('name') }}>
	</div>
	<div>
		<label for="email">Email</label>
		<input type="text"
			   name="email"
			   value={{ old('email') }}>
	</div>
	<div>
	    <input type="submit" value="Create Person" class="btn btn-primary">
	</div>
</form>
@endsection
