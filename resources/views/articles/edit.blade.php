@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Article</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" required>{{ $article->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category_id" class="form-control">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id === $article->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="author_id" value="{{ $article->author_id }}">
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d') : '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
        </form>
    </div>
@endsection
