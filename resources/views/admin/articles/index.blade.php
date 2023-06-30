@extends('layouts.admin')
@section('content')
<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/articles.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('css/footer.css') }}" rel="stylesheet">-->
    <script src="{{ asset('JavaScript/myScript.js') }}"></script>
</head>

<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1>All Articles</h1>

    <div class="mb-3">
        <a href="{{ route('admin.articles.createForm') }}" class="btn btn-primary">Add Articles</a>
    </div>

    <table id="articles-table" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1;
            @endphp
            @foreach($articles as $article)
            <tr>
                <td>{{ $count }}</td>
                <td><a href="{{ route('admin.articles.show', $article->id) }}">{{ $article->title }}</a></td>
                <td>{{ $article->content }}</td>
                <td>{{ $article->category->name }}</td>
                <td>
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @php
                $count++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>
@endsection
