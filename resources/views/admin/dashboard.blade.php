@extends('layouts.admin')

@section('content')

<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('css/footer.css') }}" rel="stylesheet">-->

    <!-- Scripts -->
    <script src="{{ asset('JavaScript/myScript.js') }}"></script>
    <!-- Latest compiled JavaScript -->

</link>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Welcome Admin Panel</h1>

                    <p class="card-text"><small class="text-muted"></small></p>

                    @foreach ($articles->sortByDesc('created_at')->take(5) as $article)
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('admin.articles.show', $article->id) }}">{{ $article->title }}</a>
                                </h5>
                                <img src="{{ Storage::url($article->image_url) }}" alt="{{ $article->title }}" class="article-image" style="max-width: 80%; height: auto;">
                                <p class="card-text">Category: {{ $article->category->name }}</p>
                                <p class="card-text"><small class="text-muted">Published Date: {{ $article->created_at->format('F j, Y') }}</small></p>
                                <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-primary">Read More</a>
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
                <div class="card-header">{{ __('Latest Articles') }}</div>
                <div class="card-body">
                    <ul>
                        @foreach ($articles->sortByDesc('created_at')->take(5) as $article)
                        <li><a href="{{ route('admin.articles.show', $article->id) }}">{{ $article->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Category Links') }}</div>
                <div class="card-body">
                    <ul>
                        @foreach($categories as $category)
                        <li><a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>

        </div>
    </div>
</div>
</div>
@endsection
