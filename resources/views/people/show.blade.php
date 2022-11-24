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
@endsection
