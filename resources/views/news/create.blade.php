@extends('layouts.app')

@section('head')
    <script src="https://cdn.tiny.cloud/1/asp4o3ypemkuhbybzd8iv80vklbkrqdfzictiksq03k71pnd/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')

    <script>
        tinymce.init({
            selector: '#newsItemBody',
            plugins: 'anchor autolink autoresize charmap code emoticons fullscreen image link lists media preview searchreplace table visualblocks visualchars wordcount',
            toolbar: 'undo redo | fontselect fontsizeselect | bold italic underline strikethrough | link image media table | align | numlist bullist | emoticons | removeformat | code fullscreen | searchreplace | charmap hr | visualblocks visualchars',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            paste_data_images: true,
        });
    </script>
@endsection
