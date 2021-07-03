@extends('layouts.public')

@section('content')
    @foreach ($posts as $post)
        <h3>{{ $post->title }}</h5>
        <p>{{ substr($post->content, 0, 80) }}</p>

        <a href="{{ route('posts.show', ['slug' => $post->slug ]) }}">Show more</a>
    @endforeach
@endsection

