@extends('layout')
@section('title', 'User Management')
@section('content')

<div class="has-text-right">
    <a class="button" href="/users/create">Add a new user</a>
</div>
<h2 class="title">Assigned to me</h2>
<table class="table is-fullwidth is-hoverable">
    <thead>
        <tr>
            <th>Name</th>
            <th>E-Mail</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
            @foreach($users AS $user)
                <tr>
                    <th scope="row">{{ $user->name }}</th>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="/users/{{ $user->id }}/edit"><i class="fas fa-edit"></i></a>
                        <a href="/users/{{ $user->id }}/delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>

{{ $users->links('global.pagination') }}
@endsection