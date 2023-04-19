@extends('layouts.app')

@section('head')
    <script src="https://cdn.tiny.cloud/1/asp4o3ypemkuhbybzd8iv80vklbkrqdfzictiksq03k71pnd/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Edit article</h2>
    <form action="{{ route('news.update', ['news' => $newsItem->id]) }}" method="POST">
        <div class="mb-3">
            <label for="newsTitle" class="from-label">Title</label>
            <input type="text" name="title" class="form-control" id="newsTitle" value="{{$newsItem->title}}" >
        </div>
        <div class="mb-3">
            <div class="news-form-image">
                <img src="{{ $newsItem->image_url }}" class="news-form-image__img" alt="Image for article">
            </div>

            <label class="form-label" for="imageForArticle">Image for Article</label>
            <input type="file" class="form-control" id="imageForArticle" name="image">
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="{{ $newsItem->is_active }}" name="is_active" id="isArticleActive">
            <label for="isArticleActive" class="form-check-label">Show article for users</label>
        </div>
        <div class="mb-3">
            <label for="tagsList" class="form-label">Tags</label>
            <textarea name="tags" id="tagsList" class="form-control">{{ $newsItem->tags_list }}</textarea>
        </div>
        <div class="mb-3">
            <label for="newsItemBody">Article content</label>
            <textarea name="body" id="newsItemBody">{{ $newsItem->body }}</textarea>
        </div>
    </form>
</div>

<script>
    tinymce.init({
        selector: '#newsItemBody',
        plugins: 'anchor autolink autoresize charmap code emoticons fullscreen image link lists media preview searchreplace table visualblocks visualchars wordcount',
        toolbar: 'undo redo | fontselect fontsizeselect | bold italic underline strikethrough | link image media table | align | numlist bullist | emoticons | removeformat | code fullscreen | searchreplace | charmap hr | visualblocks visualchars',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ]
    });

</script>
@endsection
