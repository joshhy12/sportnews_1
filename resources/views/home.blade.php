@extends('layouts.home')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Welcome to Our Article Page</h1>
                    <p class="card-text"><small class="text-muted"></small></p>
                    @foreach ($articles->sortByDesc('created_at') as $article)
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('articles.show', $article->id) }}" class="link-style">{{ $article->title }}</a>
                                </h5>
                                <img src="{{ Storage::url($article->image_url) }}" alt="{{ $article->title }}" class="article-image" style="max-width: 100%; height: auto;">
                                <p class="card-text">Category: {{ $article->category->name }}</p>
                                <p class="card-text">
                                    <small class="text-muted">Published Date:
                                        {{ $article->created_at->format('F j, Y') }}</small>
                                </p>
                                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Read More</a>
                            </div>
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
                <div class="card-header">{{ __('Latest Articles') }}</div>
                <div class="card-body">
                    <ul>
                        @foreach ($articles->sortByDesc('created_at')->take(5) as $article)
                        <li><a href="{{ route('articles.show', $article->id) }}" class="link-style">{{ $article->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Category Links') }}</div>
                <div class="card-body">
                    <dl>
                        @foreach($categories as $category)
                        <dt>
                            &nbsp; <a href="{{ route('categories.show', $category->id) }}" class="link-style" style="color: black; text-decoration: none;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">{{ $category->name }}</a>
                        </dt>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
