@extends('layout')
@section('title', 'Edit User')
@section('content')

<form method="POST" action="/users/{{ $user->id }}">
@csrf
@method('PATCH')
    <div class="field">
        <label class="label">Name</label>
        <div class="control has-icons-left">
            <input class="input" name="name" type="text" value="{{ $user->name }}" placeholder="Full name...">
            <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
            </span>
        </div>
    </div>
    <div class="field">
        <label class="label">Name</label>
        <div class="control has-icons-left">
            <input class="input" name="email" type="email" value="{{ $user->email }}" placeholder="Email address...">
            <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
            </span>
        </div>
    </div>
    
    <div class="field">
        <label class="label">Role</label>
        <div class="control">
            <div class="select">
                <select name="role">
                
                    <option value="writer" {{ $user->role == 'writer' ? 'selected' : '' }}>Writer</option>
                    <option value="seo" {{ $user->role == 'seo' ? 'selected' : '' }}>SEO</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        </div>
    </div>
    <div class="field">
        <label class="label">Password</label>
        <div class="control has-icons-left">
            <input class="input" name="password" type="password" placeholder="Enter a password or leave it blank...">
            <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
            </span>
        </div>
    </div>   
    <div class="field">
            <label class="label">Password Confirmation</label>
            <div class="control has-icons-left">
                <input class="input" name="password_confirmation" type="password" placeholder="Re-enter password.">
                <span class="icon is-small is-left">
                <i class="fas fa-key"></i>
                </span>
            </div>
        </div>       
    <div class="field">
        <p class="control">
            <button class="button is-success">
            Save Changes
            </button>
        </p>
    </div>
</form>
@endsection