@extends('layouts.application')
@section('title', 'Show Person')

@section('content')

<div class="d-flex justify-content-between">
    <div>
        <a href="{{ route('people.index') }}"
           class="btn btn-outline-secondary">
            People List
        </a>
    </div>
    <h1>Show Person</h1>
    <div>
        <a href="{{ route('people.edit', $person) }}"
           class="btn btn-primary">
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
    <div class="d-flex justify-content-between">
        <h2>Notes</h2>
    </div>

    <form id="new_note"
          action="{{ route('notes.store') }}"
          method="post">
        @csrf
        <input type="hidden"
               name="notable_id"
               value="{{ old('notable_id', $person->id) }}">
        <input type="hidden"
               name="notable_type"
               value="{{ old('noter_type', get_class($person)) }}">
        <div>
            <textarea name="content">{{ old('content') }}</textarea>
        </div>
        <div>
            <button type="submit"
                    value="Create Note"
                    class="btn btn-primary">
                Create Note
            </button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Content</th>
                <th>By</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($person->notes()->orderByDesc('created_at')->get() as $note)
                <tr id="note_{{ $note->id }}">
                    <td>
                        <x-markdown>{{ $note->content }}</x-markdown>
                    </td>
                    <td>
                        <div>{{ $note->noter->name }}</div>
                        <div class="fs-6 fw-lighter">{{ $note->created_at->toDateTimeString() }}</div>
                    </td>
                    <td>
                        <a href="{{ route('notes.edit', $note->id) }}"
                           class="btn btn-sm btn-outline-secondary">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if ($person->avatar_path)
    <img src="{{ Storage::url($person->avatar_path) }}">
@endif
@endsection
