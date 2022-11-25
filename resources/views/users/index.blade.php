@extends('layouts.application')
@section('title', 'Users')

@section('content')

<div class="d-flex justify-content-between">
    <h1>Users</h1>
    <div>
        <a href="{{ route('users.create') }}"
           class="btn btn-outline-secondary">
            New User
        </a>
    </div>
</div>
<div id="users">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr id="user_{{ $user->id }}">
                    <td>
                        <a href="{{ route('users.show', $user->id) }}">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
