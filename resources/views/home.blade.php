@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('post.create')

    @include('post.index')
@endsection
