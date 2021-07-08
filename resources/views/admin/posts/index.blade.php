@extends('layouts.app')

@section('content')
    <h1>Posts List</h1>

    <a href="{{ route('admin.posts.create') }}">Add your post...</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Slug</th>
                <th>User</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->category ? $post->category->name : '-' }}</td>
                <td>{{ $post->user->name }}</td> 

                <td><a href="{{ route('admin.posts.show', ['post' =>$post->id]) }}">Details...</a></td>
                <td><a href="{{ route('admin.posts.edit', ['post' =>$post->id]) }}">Edit...</a></td>
                <td>
                    <form action="{{ route('admin.posts.destroy', ['post' =>$post->id]) }}" method="post">

                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection


