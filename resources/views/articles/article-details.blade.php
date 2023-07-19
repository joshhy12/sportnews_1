@extends('layouts.home')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/comments.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="{{ asset('javaScript/comments.js') }}"></script>


<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Read Articles') }}</div>
                <div class="container">
                    <h1>{{ $article->title }}</h1>

                    <img src="{{ Storage::url($article->image_url) }}" alt="{{ $article->title }}" class="article-image">
                    <p>{!! $article->content !!}</p>
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


                    <!-- ... -->

                    <div>
                        <h3>Add a Comment</h3>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <div class="form-group">
                                <label for="username">Name</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Comment</label>
                                <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>

                    </div>

                    <!-- ... -->


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
                <div class="card-header">{{ __('Related Articles') }}</div>
                <div class="card-body">
                    <ol type="I">
                        @if ($relatedArticles && $relatedArticles->count() > 0)
                        @foreach ($relatedArticles as $relatedArticle)
                        <li><a href="{{ route('articles.show', $relatedArticle->id) }}">{{ $relatedArticle->title }}</a></li>
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
                            &nbsp; <a href="{{ route('categories.show', $category->id) }}" class="link-style" style="color: black; text-decoration: none;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">{{ $category->name }}</a>
                        </dt>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('javaScript/comments.js') }}"></script>

</div>
@endsection
