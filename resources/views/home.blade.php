@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('components.post.create')

    <!-- Newsfeed -->
    <section id="newsfeed" class="space-y-6">
        @include('components.post.index', ['posts' => $posts])
    </section>
    <!-- /Newsfeed -->
@endsection
