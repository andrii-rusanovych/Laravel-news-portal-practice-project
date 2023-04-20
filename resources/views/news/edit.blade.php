@extends('layouts.app')

@section('head')
    <script src="https://cdn.tiny.cloud/1/asp4o3ypemkuhbybzd8iv80vklbkrqdfzictiksq03k71pnd/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Edit article</h2>
    <form action="{{ route('news.update', ['news' => $newsItem->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-3">
            <label for="newsTitle" class="from-label">Title</label>
            <input type="text" name="title" class="form-control" id="newsTitle" value="{{ old('title',$newsItem->title) }}"  required minlength="8" maxlength="255">
            <div class="invalid-feedback">
               Article title should have length of 8 - 255 characters
            </div>
            @if ($errors->has('title'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('title') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="mb-3">
            <div class="news-form-image">
                <img src="{{ $newsItem->image_url }}" class="news-form-image__img" alt="Image for article">
            </div>

            <label class="form-label" for="imageForArticle">Image for Article</label>
            <input type="file" accept="image/*" class="form-control" id="imageForArticle" name="image">
            @if ($errors->has('image'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('image') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form-check mb-3 ">
            <input class="form-check-input news-from-checkbox__input" type="checkbox" value="1"  name="is_active" id="isArticleActive" {{ old('is_active', $newsItem->is_active) ? 'checked' : '' }}>
            <label for="isArticleActive" class="form-check-label news-from-checkbox__label">Show article for users</label>
            @if ($errors->has('is_active'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('is_active') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="tagsList" class="form-label">Tags</label>
            <textarea name="tags" id="tagsList" class="form-control" >{{ old('tags', $newsItem->tags_list) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="newsItemBody">Article content</label>
            <textarea name="body" id="newsItemBody">{{ old('body' ,$newsItem->body) }}</textarea>
            @if ($errors->has('body'))
                <div class="alert alert-danger mb-3">
                    <ul>
                        @foreach ($errors->get('body') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="invalid-feedback">
                Article body should have minimum length of 10 characters
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Update</button>
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
