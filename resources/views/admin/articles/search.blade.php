@extends('layouts.admin')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Articles Search') }}</div>
                <div class="container">

    <div class="container">
    <h1>Search Results for  <span style="text-decoration: underline; color: #7FFFD4;">{{ $searchTitle }}</span></h1>

        @if ($articles->count() > 0)
            <div class="mb-3">
                <p>{{ $articles->count() }} articles found:</p>
            </div>

            @foreach ($articles as $article)
                <div class="mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('admin.articles.show', $article->id) }}">{{ $article->title }}</a>
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


                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="{{ route('admin.articles.search') }}" method="GET">
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
                <div class="card-header">{{ __('Related Articles') }}</div>
                <div class="card-body">
                    <ol type="I">
                        @if ($relatedArticles && $relatedArticles->count() > 0)

                        @foreach ($relatedArticles as $relatedArticle)
                        <li><a href="{{ route('admin.articles.show', $relatedArticle->id) }}">{{ $relatedArticle->title }}</a></li>
                        @endforeach

                        @else
                        <p>No related articles available.</p>
                        @endif
                    </ol>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Category Links') }}</div>
                <div class="card-body">
                    <dl>
                        @foreach($categories as $category)
                        <dt>
                            &nbsp; <a href="{{ route('admin.categories.show', $category->id) }}" class="link-style" style="color: black; text-decoration: none;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">{{ $category->name }}</a>
                        </dt>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
