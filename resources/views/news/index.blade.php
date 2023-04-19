@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-6 row-cols-sm-6 g-4">
        @foreach($news as $newsItem)
            <div class="col">
                <div class="card h-100">
                    <img src="{{$newsItem->image_url}}" alt="" class="card-img-top img-fluid">
                    <div class="card-body">
                        <h5 class="card-title">{{ $newsItem->title }}</h5>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('news.edit', ['news'=>$newsItem->id]) }}" class="btn btn-primary" >Edit</a>
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
    <div class="container"></div>
@endsection
