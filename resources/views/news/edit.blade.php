@extends('layout')
@section('title', 'Post News')
@section('content')
@push('css')

@endpush
@push('js')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea#textarea' });</script>
@endpush

<form method="POST" action="/news/{{ $news->id }}">
@csrf
@method('PATCH')
    <div class="field">
        <label class="label">News Title</label>
        <div class="control has-icons-left">
            <input class="input" name="title" type="text" placeholder="Enter a title...">
            <span class="icon is-small is-left">
            <i class="fas fa-quote-right"></i>
            </span>
        </div>
    </div>
    <div class="field">
        <label class="label">News Lead</label>
        <div class="control">
            <textarea class="textarea" name="lead" placeholder="Lead..." rows="5"></textarea>
        </div>
    </div>
    <div class="field">
        <label class="label">News Content</label>
        <div class="control">
            <textarea id="textarea" class="textarea" name="content" placeholder="News content..." rows="15"></textarea>
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