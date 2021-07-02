@extends('layouts.app')

@section('content')
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>


    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" id="title">

        <label for="sale_date">Content</label>
        <input type="text" name="content" id="content">

        <input type="submit" value="Confirm">
    </form>
@endsection
