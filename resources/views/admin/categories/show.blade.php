@extends('layouts.admin')

@section('content')
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
@endsection
