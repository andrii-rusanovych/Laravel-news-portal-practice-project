@extends('layouts.news_form')

@section('news_form')
    <h2 class="text-center">Create article</h2>
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="newsTitle" class="from-label">Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="newsTitle" value="{{ old('title') }}"  required minlength="8" maxlength="255">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <div class="col-xl-9 col-lg-8 col-md-6 col-sm-12">
                <label class="form-label" for="imageForArticle">Image for Article</label>
                <input type="file" accept="image/*"  class="form-control @error('image') is-invalid @enderror" id="imageForArticle" name="image">
                @if($errors->has('image'))
                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                @else
                    <div class="form-text">
                        Image is required, must be less than 2mb
                    </div>
                @endif
            </div>
        </div>
        <div class="form-check mb-3 ">
            <input class="form-check-input news-from-checkbox__input " type="checkbox" value="1"  name="is_active" id="isArticleActive" @if(old('is_active')) checked @endif>
            <label for="isArticleActive" class="form-check-label news-from-checkbox__label">Show this article on the website</label>
        </div>
        <div class="mb-3">
            <label for="tagsList" class="form-label">Tags</label>
            <textarea name="tags" id="tagsList" class="form-control @error('tags') is-invalid @enderror" >{{ old('tags') }}</textarea>
            @if($errors->has('tags'))
                <div class="invalid-feedback">{{ $errors->first('tags') }}</div>
            @else
                <div class="form-text">
                    Each tag must be unique across the entire website. Tags must be comma-separated (A tag is a word that, when found in another news article, is automatically turned into a hyperlink that points to that article.)
                </div>
            @endif
        </div>
        <div class="mb-3 form-group">
            <label for="tinymceRichText">Article content</label>
            <div class="{{ $errors->has('body') ? 'tinymce-error' : '' }}">
                <textarea name="body" id="tinymceRichText" class="form-control">{{ old('body') }}</textarea>
            </div>
            @error('body')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        @if ($errors->has('is_active'))
            <div class="alert alert-danger mb-3">
                <ul>
                    @foreach ($errors->get('is_active') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Create</button>
        </div>
    </form>
@endsection
