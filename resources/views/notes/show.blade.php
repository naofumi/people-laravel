@extends('layouts.application')
@section('title', 'Show Note')

@section('content')

<div class="d-flex justify-content-between">
    <h1>Show Note</h1>
    <div>
        <a href="{{ route('notes.edit', $note) }}" class="btn btn-primary">
            Edit Note
        </a>
    </div>
</div>
<div>
    <p>
        <strong>Created by:</strong>
        {{ $note->noter->name }}
    </p>

    <p>
        <strong>Content:</strong>
        <x-markdown>{{ $note->content }}</x-markdown>
    </p>
</div>
@endsection
