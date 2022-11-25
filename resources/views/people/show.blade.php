@extends('layouts.application')
@section('title', 'Show Person')

@section('content')

<div class="d-flex justify-content-between">
    <h1>Show Person</h1>
    <div>
        <a href="{{ route('people.edit', $person) }}" class="btn btn-primary">
            Edit Person
        </a>
    </div>
</div>
<div>
    <p>
        <strong>Name:</strong>
        {{ $person->name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $person->email }}
    </p>
</div>
<div id="notes">
    <h2>Notes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>By</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($person->notes as $note)
                <tr id="note_{{ $note->id }}">
                    <td>
                        {{ $note->commenter->name }}
                    </td>
                    <td>
                        {{ $note->content }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('notes.create') }}" class="btn btn-primary">
        Create note
    </a>
</div>
@endsection
