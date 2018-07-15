@extends('layout')
@section('title', 'Add News To Tracker')
@section('content')
<form method="POST" action="/news/assign">
@csrf
    <div class="field">
        <label class="label">News Source</label>
        <div class="control has-icons-left">
            <input class="input" name="url" type="text" placeholder="URL of news source...">
            <span class="icon is-small is-left">
            <i class="fas fa-arrow-circle-right"></i>
            </span>
        </div>
    </div>
    <div class="field">
        <label class="label">Assign to</label>
        <div class="control">
            <div class="select">
            <select name="user_id">
                @foreach($users AS $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        </div>
    </div>
    <div class="field">
        <p class="control">
            <button class="button is-success">
            Add
            </button>
        </p>
    </div>
</form>
@endsection