@extends('layouts.application')
@section('title', 'Show Person')

@section('content')

<div class="d-flex justify-content-between">
    <h1>Show Person</h1>
    <div>
        <a href="{{ route('people.index') }}" class="btn btn-primary">
            List of People
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
