@extends('layout')
@section('title', 'News Tracker Index')
@section('content')
<table class="table is-fullwidth is-hoverable">
    <thead>
        <tr>
            <th>date</th>
            <th>Source Website</th>
            <th>Assigned to</th>
            <th>Writer Status</th>
            <th>Published</th>
            <th>SEO</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
            @foreach($newsitems AS $news)
                <tr>
                    <th scope="row">{{ $news->created_at->diffForHumans() }}</th>
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
                <td><a href="/admin/news/{{ $news->id }}/edit"><i class="fas fa-edit"></i></a> <a href="/admin/news/{{ $news->id }}/delete"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            @endforeach
    </tbody>
</table>
{{ $newsitems->links('global.pagination') }}
@endsection