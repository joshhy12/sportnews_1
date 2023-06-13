@extends('layouts.home')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>All Articles</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->content }}</td>
                        <td>{{ $article->category->name }}</td>
                        <td>
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary">Edit</a>

                        </td>
                        <td>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
