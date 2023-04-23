@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center flex-column mt-3">
    <h1 class="text-center">News application</h1>
    <a href="{{ route('public.news.index') }}">Go to news)</a>
</div>
@endsection
