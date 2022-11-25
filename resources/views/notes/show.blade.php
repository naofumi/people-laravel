@extends('layouts.application')
@section('title', 'Show Note')

@section('content')

<div class="d-flex justify-content-between">
    <h1>Show Note</h1>
    <div>
        <a href="{{ route('notes.edit', $note) }}"
           class="btn btn-outline-secondary">
            Edit Note
        </a>
    </div>
</div>
<div>
    <p>
        <strong>Created by:</strong>
        <a href="{{ route('people.show', $note->notable) }}">{{ $note->noter->name }}</a>
    </p>

    <p>
        <strong>Content:</strong>
        <x-markdown>{{ $note->content }}</x-markdown>
    </p>
</div>
@endsection
