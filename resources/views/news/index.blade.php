@extends('layout')
@section('title', 'News Tracker')
@section('content')

<h2 class="title">Assigned to me</h2>
<table class="table is-fullwidth is-hoverable">
    <thead>
        <tr>
            <th>date</th>
            <th>Source Website</th>
            <th>Article Status</th>
            <th>Published</th>
            <th>SEO</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
            @foreach(Auth::user()->news AS $news)
                <tr>
                    <th scope="row">{{ $news->created_at->toFormattedDateString() }}</th>
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

<h2 class="title">All News Items</h2>
<table class="table is-fullwidth is-hoverable">
    <thead>
        <tr>
            <th>date</th>
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