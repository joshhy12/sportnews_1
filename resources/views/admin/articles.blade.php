@extends('layouts.app')

@section('content')
    <h1>Manage Articles</h1>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary mb-3">Create Article</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td>{{ $article->status }}</td>
                    <td>
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
