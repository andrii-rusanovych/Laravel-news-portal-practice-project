<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#tinymceRichText',
        plugins: 'anchor autolink autoresize charmap code emoticons fullscreen image link lists media preview searchreplace table visualblocks visualchars wordcount',
        toolbar: 'undo redo | fontselect fontsizeselect | bold italic underline strikethrough | link image media table | align | numlist bullist | emoticons | removeformat | code fullscreen | searchreplace | charmap hr | visualblocks visualchars',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        paste_data_images: true,
        content_css: 'tinymce-5'
    });
</script>
