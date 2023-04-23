@extends('layouts.app')

@section('head')
    <!-- Insert the blade containing the TinyMCE configuration and source script -->
    <x-head.tinymce-config/>
@endsection


@section('content')
    <div class="container">
        @yield('news_form')
    </div>
@endsection
