@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('js/tinymce/skins/ui/tinymce-5/content.min.css') }}" />
@endsection

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('public.news.index') }}">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $newsItem->title }}</li>
            </ol>
        </nav>
        <h1>{{ $newsItem->title }}</h1>
        <img src="{{$newsItem->image_url}}" alt="image for article" class="news-show_image">
        <p class="card-text mt-3">Article posted at {{ $newsItem->created_at->format('Y/m/d H:i') }}</p>
        <div class="content">
            {!! $wrappedBody !!}
        </div>
        <div class="navigation mt-4">
            @if ($previousNewsItem != null)
                <a href="{{ route('public.news.show', $previousNewsItem->id) }}" class="btn btn-primary news-show__previous-link">&larr; Previous</a>
            @endif
            @if ($nextNewsItem != null)
                <a href="{{ route('public.news.show', $nextNewsItem->id) }}" class="btn btn-primary">Next &rarr;</a>
            @endif
        </div>
    </div>
@endsection
