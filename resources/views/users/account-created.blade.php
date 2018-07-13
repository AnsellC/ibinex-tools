@extends('layout')
@section('title', 'Account creation')
@section('content')
<p class="subtitle has-text-centered">Account created for <strong>{{ $user->name }}</strong>. Please login using:</p>
    <p class="title has-text-centered" style="background: #F5F5F5; padding: 1em; margin: 1em;">{{ $temp_password }}</p>
    <p class="subtitle has-text-centered">Make sure to change your password after logging in.</p>
@endsection