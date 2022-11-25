@extends('layouts.application')
@section('title', 'Edit Note')

@section('content')

<div class="d-flex justify-content-between">
	<h1>Edit Note</h1>
	<div>
		<a href="{{ route('notes.show', $note) }}"
		   class="btn btn-outline-secondary">
			Show Note
		</a>
	</div>
</div>
@include('shared.errors')

<form action="{{ route('notes.update', $note) }}" method="post">
	@csrf
	@method('patch')
	<div>
		<label for="content">Content</label>
		<textarea name="content">{{ old('content', $note->content) }}</textarea>
	</div>
	<div>
	    <input type="submit" value="Update Note" class="btn btn-primary">
	</div>
</form>
<div class="d-flex justify-content-between">
	<div></div>
	<form action="{{ route('notes.destroy', $note) }}" method="post" data-turbo-confirm="Are you sure you want to delete this note">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger">Delete Note</button>
	</form>
</div>
@endsection
