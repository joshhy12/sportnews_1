@extends('layouts.admin')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="container">
        <h1>{{ $category->name }}</h1>
        <p>{{ $category->description }}</p>

        <h2>Articles</h2>
        <ul>
            @foreach ($category->articles as $article)
                <li><a href="{{ route('admin.articles.show', $article->id) }}">{{ $article->title }}</a></li>
            @endforeach
        </ul>
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



                        <p>No related articles available.</p>

                    </ol>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Category Links') }}</div>
                <div class="card-body">
                    <dl>

                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
