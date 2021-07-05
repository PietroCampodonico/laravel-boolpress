@include('layouts.app')

@section('content')
<h1>Available Categories</h1>

@section('content')
<h1>Tags List</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Slug</th>
            <th class="text-center">Count post</th>
            <th class="text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
        <tr>
            <td>{{ $tag->id }}</td>
            <td>{{ $tag->name }}</td>
            <td>{{ $tag->slug }}</td>
            {{-- <td class="text-center">
                <a href="{{ route('admin.posts.filter', ["tag"=>$tag->id]) }}">
                    {{ count($tag->posts) }}
                </a>
            </td> --}}
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>

