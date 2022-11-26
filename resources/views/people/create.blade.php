@extends('layouts.application')
@section('title', 'Create Person')

@section('content')

<div class="d-flex justify-content-between">
	<div>
		<a href="{{ route('people.index') }}"
		   class="btn btn-outline-secondary">
			List of People
		</a>
	</div>
	<h1>Create Person</h1>
	<div>
	    <button type="submit"
	    		form="new_person"
	    		value="Submit"
	    		class="btn btn-warning">Create Person</button>

	</div>
</div>
@include('shared.errors')
<form id="new_person"
	  action="{{ route('people.store') }}"
      method="post"
      enctype="multipart/form-data">
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
		<label for="avatar">Avatar</label>
		<input type="file"
			   name="avatar">
	</div>
</form>
@endsection
