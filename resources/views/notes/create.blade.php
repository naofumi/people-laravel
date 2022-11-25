@extends('layouts.application')
@section('title', 'Create Note')

@section('content')

<div class="d-flex justify-content-between">
	<h1>Create Note</h1>
	<div>
		<a href="{{ route('notes.index') }}" class="btn btn-primary">
			List of Notes
		</a>
	</div>
</div>
@include('shared.errors')

<form action="{{ route('notes.store') }}" method="post">
	@csrf
	<input type="hidden"
		   name="notable_id"
		   value="{{ old('notable_id', $notable->id) }}">
	<input type="hidden"
		   name="notable_type"
		   value="{{ old('noter_type', get_class($notable)) }}">
	<div>
		<label for="content">Content</label>
		<textarea name="content">{{ old('content') }}</textarea>
	</div>
	<div>
	    <input type="submit" value="Create Note" class="btn btn-primary">
	</div>
</form>
@endsection
