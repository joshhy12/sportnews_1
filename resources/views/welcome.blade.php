@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to Our Article Page</h1>

    @foreach ($articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                {{ $article->title }}
            </h5>

            <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" class="article-image">
            <p class="card-text">{{ $article->body }}</p>
            <p class="card-text"><small class="text-muted">{{ $article->created_at->format('F j, Y') }}</small></p>
        </div>
    </div>
    @endforeach
</div>
@endsection
