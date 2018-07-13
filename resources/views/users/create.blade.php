@extends('layout')
@section('title', 'Add User')
@section('content')
<form method="POST" action="/users">
@csrf
    <div class="field">
        <label class="label">Name</label>
        <div class="control has-icons-left">
            <input class="input" name="name" type="text" placeholder="Full name...">
            <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
            </span>
        </div>
    </div>
    <div class="field">
        <label class="label">Name</label>
        <div class="control has-icons-left">
            <input class="input" name="email" type="email" placeholder="Email address...">
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
                <option value="writer">Writer</option>
                <option value="seo">SEO</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <button class="button is-success">
            Add User
            </button>
        </p>
    </div>
</form>
@endsection