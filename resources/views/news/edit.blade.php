@extends('layouts.news_form')

@section('news_form')
    <h2 class="text-center">Edit article</h2>
    <form action="{{ route('admin.news.update', ['news' => $newsItem->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-3">
            <label for="newsTitle" class="from-label">Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="newsTitle" value="{{ old('title',$newsItem->title) }}"  required minlength="8" maxlength="255">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="row mb-3">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="news-form-image">
                    <img src="{{ $newsItem->image_url }}" class="news-form-image__img" alt="Image for article">
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-6 col-sm-12">
                <label class="form-label" for="imageForArticle">Image for Article</label>
                <input type="file" accept="image/*"  class="form-control @error('image') is-invalid @enderror" id="imageForArticle" name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-check mb-3 ">
            <input class="form-check-input news-from-checkbox__input " type="checkbox" value="1"  name="is_active" id="isArticleActive" {{ old('is_active', $newsItem->is_active) ? 'checked' : '' }}>
            <label for="isArticleActive" class="form-check-label news-from-checkbox__label">Show this article on the website</label>
        </div>
        <div class="mb-3">
            <label for="tagsList" class="form-label">Tags</label>
            <textarea name="tags" id="tagsList" class="form-control @error('tags') is-invalid @enderror" >{{ old('tags', $newsItem->tags_list) }}</textarea>
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
                <textarea name="body" id="tinymceRichText" class="form-control">{{ old('body' ,$newsItem->body) }}</textarea>
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
            <button type="submit" class="btn btn-primary btn-lg">Update</button>
            <button type="button" class="btn btn-danger news-form-delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                Delete News Item
            </button>
        </div>
    </form>
    <form action="{{ route('admin.news.destroy',['news' => $newsItem->id]) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
        <!-- Other form fields here -->
    </form>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this news item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            document.getElementById('delete-form').submit();
        });
    </script>
@endsection
