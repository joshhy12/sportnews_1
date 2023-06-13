@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>All Categories</h1>

        <div class="mb-3">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container">
        <h3>Category Links:</h3>
        <ul>
            @foreach($categories as $category)
                <li><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
