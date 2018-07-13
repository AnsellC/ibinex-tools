@extends('layout')
@section('title', $news->title)
@section('content')

    <div class="field">
        <label class="label">News Source</label>
        <div class="control">
            <a href="{{ $news->url }}" target="_blank">{{ $news->url }}</a>
        </div>
    </div>

    <div class="field">
        <label class="label">News Title</label>
        <div class="control has-icons-left">
            {{ $news->title }}
        </div>
    </div>
    <div class="field">
        <label class="label">News Lead</label>
        <div class="control">
            {{ $news->lead }}
        </div>
    </div>
    <div class="field">
        <label class="label">News Content</label>
        <div class="control">
            {!! $news->content !!}
        </div>
    </div>

    <div class="field">
        <label class="label">Photo</label>
        <div class="control">
            {{ $news->photo }}
        </div>
    </div>
    
    <div class="field">
        <label class="label">Status</label>
            {!! $news->is_finished ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!} Writer is finished?<br />
            {!! $news->is_published ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!} Published to news.ibinex.com? <br />
            {!! $news->is_seo_published ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!} Published to social media? <br />
    </div>
<div class="columns">
    <div class="column has-text-centered">
            @if( (Auth::user()->id == $news->id OR Auth::user()->can('admin')) AND !$news->is_finished )
                <a class="button is-danger" href="/news/{{ $news->id }}/finished">Mark as finished article</a>
            @endif
            @if( Auth::user()->can('admin_or_seo') )
                @if( !$news->is_published )
                    <a class="button is-primary" href="/news/{{ $news->id }}/published">Mark as Published on news.ibinex.com</a> 
                @elseif( !$news->is_seo_published )
                    <a class="button is-link" href="/news/{{ $news->id }}/seo">Mark as Published on social media</a>
                @endif
            @endif
    </div>
</div>
@endsection