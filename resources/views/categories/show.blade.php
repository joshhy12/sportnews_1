<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>

<body .fixed-div { position: sticky; top: 0px; /* Adjust the value as needed */ }>
    @extends('layouts.home')
    @section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">


                    <div class="container">
                        <h1>{{ $category->name }}</h1>
                        <p>{{ $category->description }}</p>

                        <h2>Articles</h2>
                        <ul>
                            @foreach ($category->articles as $article)
                            <li><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
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
                <div class="card-header">{{ __('Latest Articles of Category') }}</div>
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
                    <dl>
                        @foreach($categories as $category)
                        <dt>
                            &nbsp; <a href="{{ route('categories.show', $category->id) }}" class="link-style" style="color: black; text-decoration: none;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">{{ $category->name }}</a>
                        </dt>
                        @endforeach
                    </dl>
                </div>
            </div>
            <br>

        </div>
    </div>
</div>
</div>
@endsection
