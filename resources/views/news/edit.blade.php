@extends('layout')
@section('title', 'Add News')
@section('content')

@push('js')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea#textarea' });

var file = document.getElementById("file");
file.onchange = function(){
    if(file.files.length > 0)
    {

      document.getElementById('file-name').innerHTML = file.files[0].name;

    }
};

</script>

@endpush

<form method="POST" action="/news/{{ $news->id }}">
@csrf
@method('PATCH')
    <div class="field">
        <label class="label">News Source</label>
        <div class="control">
            <a href="{{ $news->url }}" target="_blank">{{ $news->url }}</a>
        </div>
    </div>

    <div class="field">
        <label class="label">News Title</label>
        <div class="control has-icons-left">
            <input class="input" name="title" type="text" placeholder="Enter a title..." value="{{ $news->title }}">
            <span class="icon is-small is-left">
            <i class="fas fa-quote-right"></i>
            </span>
        </div>
    </div>
    <div class="field">
        <label class="label">News Lead</label>
        <div class="control">
            <textarea class="textarea" name="lead" placeholder="Lead..." rows="5">{{ $news->lead }}</textarea>
        </div>
    </div>
    <div class="field">
        <label class="label">News Content</label>
        <div class="control">
            <textarea id="textarea" class="textarea" name="content" placeholder="News content..." rows="15">{{ $news->content }}</textarea>
        </div>
    </div>

    <div class="field">
        <div class="file has-name">
            <label class="file-label">
                <input id="file" class="file-input" type="file" name="photo">
                <span class="file-cta">
                <span class="file-icon">
                    <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">
                    Upload a photo
                </span>
                </span>
                <span class="file-name" id="file-name"></span>
            </label>
        </div>  
    </div>
    <div class="field">
        <label class="checkbox">
            <input value="1" name="is_finished" type="checkbox" {{ $news->is_finished ? 'checked' : '' }}> Mark as finished?
        </label>
    </div>

    <div class="field">
        <p class="control">
            <button class="button is-success">
            Save News
            </button>
        </p>
    </div>      
</form>
@endsection