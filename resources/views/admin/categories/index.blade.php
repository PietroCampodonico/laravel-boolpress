@extends('layouts.app')

@section('content')
    <h1>Available Categories</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Slug</th>
                <th>Posts Count</th>
                <th class="text-center">Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ count($category->posts) }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
