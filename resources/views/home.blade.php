@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('components.post-card.create')

    <!-- Newsfeed -->
    <section id="newsfeed" class="space-y-6">
        @include('components.post-card.post', ['posts' => $posts])

        @include('components.post-card.image', ['posts' => $posts])
    </section>
    <!-- /Newsfeed -->
@endsection
