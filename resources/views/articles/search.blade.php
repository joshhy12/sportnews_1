@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Results for "{{ $query }}"</h1>

        @if ($articles->count() > 0)
            <div class="mb-3">
                <p>{{ $articles->count() }} articles found:</p>
            </div>

            @foreach ($articles as $article)
                <div class="mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                            </h5>
                            <img src="{{ Storage::url($article->image_url) }}" alt="{{ $article->title }}" class="article-image" style="max-width: 100%; height: auto;">
                            <p class="card-text">{{ $article->body }}</p>
                            <p class="card-text"><small class="text-muted">{{ $article->created_at->format('F j, Y') }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                No articles found matching the search query.
            </div>
        @endif
    </div>
@endsection
