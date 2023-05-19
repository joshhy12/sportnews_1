@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Article</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category_id" class="form-control">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="date" class="form-control" id="published_at" name="published_at">
            </div>
            <button type="submit" class="btn btn-primary">Create Article</button>
        </form>
    </div>
@endsection
