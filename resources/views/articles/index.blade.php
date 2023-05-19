<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>

<body .fixed-div { position: sticky; top: 0px; /* Adjust the value as needed */ }>
    @extends('layouts.app')
    @section('content')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1>All Articles</h1>
                        <div class="mb-3">
                            <a href="{{ route('articles.create') }}" class="btn btn-primary">Add Article</a>
                        </div>

                        @foreach ($articles as $article)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                                </h5>

                                <img src="{{ Storage::url($article->image_url) }}" alt="{{ $article->title }}" class="article-image" style="max-width: 80%; height: auto;">

                                <p class="card-text">{{ $article->content }}</p>
                                <p class="card-text"><small class="text-muted">{{ $article->created_at->format('F j, Y') }}</small></p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <form action="{{ route('articles.search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Go!</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Article Links') }}</div>
                    <div class="card-body">
                        <ul>
                            @foreach ($articles as $article)
                            <li><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">{{ __('Category Links') }}</div>
                    <div class="card-body">
                        <ul>

                        </ul>
                    </div>
                </div>
                <br>

            </div>
        </div>
    </div>
    </div>
    @endsection

</body>

</html>
