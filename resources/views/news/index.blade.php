@extends('layout')
@section('title', 'News Tracker')
@section('content')
@if( Auth::user()->can('admin') )
    <div class="has-text-right">
        <a class="button" href="/news/assign">Add News Source</a>
    </div>
@endif

@can('writer')
    <h2 class="title">{{ $mine_title }}</h2>
    <form method="get" action="/news">
        <div class="field">
            <div class="select">
                <select name="mine_show" class="select-show">

                    <option value="today" {{ request('mine_show') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="unfinished" {{ request('mine_show') == 'unfinished' ? 'selected' : '' }}>All Unfinished</option>
                    <option value="all" {{ request('mine_show') == 'all' ? 'selected' : '' }}>All Items</option>
                </select>
            </div>
        </div>

    </form>
    <table class="table is-fullwidth is-hoverable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Last Modified</th>
                <th>Source Website</th>
                <th>Article Status</th>
                <th>Published</th>
                <th>SEO</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                @foreach($mine AS $news)
                    <tr>
                        <th scope="row">{{ $news->created_at->toFormattedDateString() }}</th>
                        <td>
                            @if($news->created_at != $news->updated_at) 
                                {{ $news->updated_at->diffForHumans() }}
                            @endif
                        </td>
                        <td><a href="{{ $news->url }}" target="_blank">{{ str_limit($news->url, 50) }}</a></td>
                        <td>
                            @if( $news->is_finished != 0 AND !empty($news->is_finished) )
                                <span class="icon has-text-success"><i class="fa fa-check-circle"></i></span>
                            @else
                                <span class="icon has-text-danger"><i class="fa fa-times-circle"></i></span>
                            @endif
                        </td>
                        <td>
                            @if( $news->is_published != 0 AND !empty($news->is_published) )
                                <span class="icon has-text-success"><i class="fa fa-check-circle"></i></span>
                            @else
                                <span class="icon has-text-danger"><i class="fa fa-times-circle"></i></span>
                            @endif
                        </td>
                        <td>
                            @if( $news->is_seo_published != 0 AND !empty($news->is_seo_published) )
                                <span class="icon has-text-success"><i class="fa fa-check-circle"></i></span>
                            @else
                                <span class="icon has-text-danger"><i class="fa fa-times-circle"></i></span>
                            @endif
                        </td>
                    <td>
                        @if( !$news->is_published AND !$news->is_seo_published )
                            <a href="/news/{{ $news->id }}/edit"><i class="fa fa-pen-alt"></i></a>
                        @endif
                        <a href="/news/{{ $news->id }}"><i class="far fa-eye"></i></a></td>
                    </tr>
                @endforeach
        </tbody>
    </table>
@endcan
<h2 class="title">{{ $all_title }}</h2>
<form method="get" action="/news">
    <div class="field">
        <div class="select">
            <select name="show" class="select-show">

                <option value="today" {{ request('show') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="unfinished_today" {{ request('show') == 'unfinished_today' ? 'selected' : '' }}>All Unfinished Today</option>
                <option value="unpublished_today" {{ request('show') == 'unpublished_today' ? 'selected' : '' }}>All Unpublished Today</option>
                <option value="unfinished" {{ request('show') == 'unfinished' ? 'selected' : '' }}>All Unfinished</option>
                <option value="unpublished" {{ request('show') == 'unpublished' ? 'selected' : '' }}>All Unpublished</option>
                <option value="all" {{ request('show') == 'all' ? 'selected' : '' }}>All Items</option>
            </select>
        </div>
    </div>

</form>
<table class="table is-fullwidth is-hoverable">
    <thead>
        <tr>
            <th>Date</th>
            <th>Last Modified</th>
            <th>Source Website</th>
            <th>Assigned to</th>
            <th>Article Status</th>
            <th>Published</th>
            <th>SEO</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
            @foreach($newsitems AS $news)
                <tr>
                    <th scope="row">{{ $news->created_at->toFormattedDateString() }}</th>
                    <td>
                        @if($news->created_at != $news->updated_at) 
                            {{ $news->updated_at->diffForHumans() }}
                        @endif
                    </td>
                    <td><a href="{{ $news->url }}" target="_blank">{{ str_limit($news->url, 50) }}</a></td>
                    <td>{{ $news->user->name }}</td>
                    <td>
                        @if( $news->is_finished != 0 AND !empty($news->is_finished) )
                            <span class="icon has-text-success"><i class="fa fa-check-circle"></i></span>
                        @else
                            <span class="icon has-text-danger"><i class="fa fa-times-circle"></i></span>
                        @endif
                    </td>
                    <td>
                        @if( $news->is_published != 0 AND !empty($news->is_published) )
                            <span class="icon has-text-success"><i class="fa fa-check-circle"></i></span>
                        @else
                            <span class="icon has-text-danger"><i class="fa fa-times-circle"></i></span>
                        @endif
                    </td>
                    <td>
                        @if( $news->is_seo_published != 0 AND !empty($news->is_seo_published) )
                            <span class="icon has-text-success"><i class="fa fa-check-circle"></i></span>
                        @else
                            <span class="icon has-text-danger"><i class="fa fa-times-circle"></i></span>
                        @endif
                    </td>
                    <td>
                        @if(Auth::user()->id == $news->id OR Auth::user()->can('admin'))
                            <a href="/news/{{ $news->id }}/edit"><i class="fas fa-edit"></i></a>
                        @endif
                        @if( Auth::user()->can('admin') )
                            <a href="/news/{{ $news->id }}/delete"><i class="fas fa-trash-alt"></i></a>
                        @endif
                        @if( Auth::user()->can('admin') OR Auth::user()->can('seo') )
                            <a href="/news/{{ $news->id }}"><i class="far fa-eye"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>
{{ $newsitems->links('global.pagination') }}
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.select-show').on('change', function(){
            if($(this).val() != '')
                $(this).parent('div').parent('div').parent('form').submit();
        });
    });
</script>
@endpush