@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('components.post.create')

    <!-- Newsfeed -->
    <section id="newsfeed" class="space-y-6">
        <livewire:post-list/>
    </section>
    <!-- /Newsfeed -->
@endsection
