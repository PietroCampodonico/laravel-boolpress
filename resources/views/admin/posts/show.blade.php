@extends('layouts.app')

@section('content')

<h1>Checking out post {{$post->id}}</h1>

<a href="{{ route('admin.posts.index') }}">Go Back to the Posts List</a>

<ul>
    <li>TITLE: {{ $post->title }}</li>
    <li>SLUG: {{ $post->slug }}</li>
    <li>CONTENT: {{ $post->content }}</li>
    {{-- <li>CATEGORY: {{ $post->category ? $post->category->name : '-' }}</li>--}}
    <li>USER: {{ $post->user->name }} ({{ $post->user->email }})</li> 

    <li><small>CREATION DATE: {{ $post->created_at }}</small></li>
    <li><small>LAST UPDATE: {{ $post->updated_at }}</small></li>

    <li><a href="{{ route('admin.posts.edit', ['post' =>$post->id]) }}">Edit...</a></li>
    <li>
        <form action="{{ route('admin.posts.destroy', ['post' =>$post->id]) }}" method="post">

            @csrf
            @method('DELETE')
            <input type="submit" value="Cancel">
        </form>
    </li>

</ul>
@endsection

