@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <livewire:post-comment :key="'comment' . $post->id" :$post/>
@endsection
