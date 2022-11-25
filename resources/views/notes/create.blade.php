@extends('layouts.application')
@section('title', 'Create Note')

@section('content')

<div class="d-flex justify-content-between">
	<div>
		<a href="{{ route('notes.index') }}"
		   class="btn btn-outline-secondary">
			List of Notes
		</a>
	</div>
	<h1>Create Note</h1>
	<div>
		<button form="new_note"
				type="submit"
				value="Create Note"
				class="btn btn-primary">
			Create Note
		</button>
	</div>
</div>
@include('shared.errors')

<form id="new_note"
      action="{{ route('notes.store') }}"
	  method="post">
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
	</div>
</form>
@endsection
