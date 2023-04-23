@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-center">
            <h1>News list</h1>
            <a href="{{ route('admin.news.create') }}" class="btn btn-outline-dark btn-lg add-new-button">Add new</a>
        </div>
    </div>
    <hr />
    <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-6 row-cols-sm-6 g-4">
        @foreach($news as $newsItem)
            <div class="col">
                <div class="card h-100">
                    <img src="{{$newsItem->image_url}}" alt="" class="card-img-top img-fluid">
                    <div class="card-body">
                        <h5 class="card-title">{{ $newsItem->title }}</h5>
                        <p class="card-text">Posted at {{ $newsItem->created_at->format('Y/m/d H:i') }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.news.edit', ['news'=>$newsItem->id]) }}" class="btn btn-primary" >Edit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center">
            {{ $news->links('pagination.bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
