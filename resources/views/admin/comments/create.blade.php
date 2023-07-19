@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Comment</h1>

        <form action="{{ route('admin.comments.store') }}" method="PUT">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content">Comment</label>
                <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="article_id">Article</label>
                <select name="article_id" id="article_id" class="form-control" required>
                    @foreach ($articles as $article)
                        <option value="{{ $article->id }}">{{ $article->title }}</option>
                    @endforeachqqqq
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
