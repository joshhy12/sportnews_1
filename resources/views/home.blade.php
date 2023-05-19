@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Welcome to Our Article Page</h1>

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
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('News Links') }}</div>

                <div class="card-body">
                    <ul>
                        @foreach ($articles as $article)
                        <li><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="col-md-4">
    <div class="card">
        <div class="card-header">{{ __('Category') }}</div>

        <div class="card-body">
            <ul>

            </ul>
        </div>
    </div>
</div>


            <br>

        </div>
    </div>


</div>
</div>
@endsection
