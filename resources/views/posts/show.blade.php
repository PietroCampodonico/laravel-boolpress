@extends('layouts.public')

@section('content')
    <h1>{{ $post->title }}</h1>
    {{ $post->updated_at }} | {{ $post->slug }} 
    | {{ $post->category ? $post->category->name : '-' }}
    <a href="{{ route('posts.index') }}"></a>
   

    <p class="lead">{{ $post->content }}</p>

    <p>Written by {{ $post->user->name }}</p>

@endsection
