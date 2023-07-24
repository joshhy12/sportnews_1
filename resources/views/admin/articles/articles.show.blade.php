@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>

    <img src="{{ Storage::url($article->image_url) }}" alt="{{ $article->title }}" class="article-image" style="max-width: 70%; height: auto;">
    <p>{{ $article->content }}</p>
    <p>Published on: {{ $article->published_at }}</p>
    <p>Category: {{ $article->category->name }}</p>

    <div class="mt-4">
    <h3>Comments</h3>
    @if ($article->comments && $article->comments->count() > 0)
        @foreach ($article->comments as $comment)
            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->username }}</h5> <!-- Use comment's username instead of user's name -->
                    <p class="card-text">{{ $comment->content }}</p>
                    <p class="card-text"><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                </div>
            </div>
        @endforeach
    @else
        <p>No comments available.</p>
    @endif
</div>


    <div class="mt-4">
        <h3>Add a Comment</h3>
        <form action="{{ route('comments.add') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Name</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Comment</label>
                <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    </div>

    <div class="mt-4">
        <h3>Related Articles</h3>
        @if ($relatedArticles && $relatedArticles->count() > 0)
            <ul>
                @foreach ($relatedArticles as $relatedArticle)
                    <li><a href="{{ route('articles.show', $relatedArticle->id) }}">{{ $relatedArticle->title }}</a></li>
                @endforeach
            </ul>
        @else
            <p>No related articles available.</p>
        @endif
    </div>
</div>
@endsection
