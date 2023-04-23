@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">404 - Page Not Found</h1>

        @auth
            @if($isAdminRoute)
                <p class="text-center"><a href="{{ route('admin.news.index') }}">Go to the news list</a>.</p>
            @else
                <p class="text-center" ><a href="{{ route('public.news.index') }}">Go to the news list</a>.</p>
            @endif
        @else
            <p class="text-center" ><a href="{{ route('public.news.index') }}">Go to the news list</a>.</p>
        @endauth
    </div>
@endsection
