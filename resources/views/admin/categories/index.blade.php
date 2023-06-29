@extends('layouts.admin')
@section('content')
<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/category.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('css/footer.css') }}" rel="stylesheet">-->
    <script src="{{ asset('JavaScript/myScript.js') }}"></script>

</link>
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1>All Categories</h1>

    <div class="mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>

    <table class="table" id="categories-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1;
            @endphp
            @foreach($categories as $category)
            <tr>
                <td>{{ $count }}</td>
                <td><a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
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

<style>

</style>

@endsection
