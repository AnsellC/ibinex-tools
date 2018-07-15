@extends('layout')
@section('title', 'Post News')
@section('content')
<form method="POST" action="/news">
@csrf

</form>
@endsection