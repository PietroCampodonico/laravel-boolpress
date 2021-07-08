@extends('layouts.app')

@section('content')

<h1>Modify Post {{ $post->id }}</h1>

<a href="{{ route('admin.posts.index') }}">Go Back to the Posts List</a>

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

@if($post->cover_url)
<img src="{{asset('storage/' . $post->cover_url)}}" alt="">
@endif
    
<form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">

@csrf
@method('PATCH')

    <div class="form-group">
        <label>Cover IMG</label>
        <input type="file" name="postCover" accept=".jpg,.png" class="form-control-file">
    </div>

    <div class="form-group">
        <label>Titolo</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Modify Title" value="{{ old('title', $post->title) }}" required>
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Contenuto</label>
        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10" placeholder="Write our post" required>{{ old('content', $post->content) }}</textarea>
        @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    {{-- categoria del post --}}
    <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control  @error('category_id') is-invalid @enderror">
            <option value="">-- Select your post category --</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- Tags --}}
    <div class="form-group">
        <label>Tags</label><br>

        @foreach($tags as $tag)

        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}" {{ $post->tags->contains($tag) ? 'checked' : '' }}>

                {{ $tag->name }}
            </label>
        </div>

        @endforeach

    </div>


    <input type="submit" value="Save changes">
</form>
@endsection

