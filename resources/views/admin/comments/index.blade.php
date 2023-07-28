@extends('layouts.admin')

@section('content')
<link href="{{ asset('css/comments.css') }}" rel="stylesheet">

<div class="container">
    <h1>Comments</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if ($comments->count() > 0)
    <table class="table" id="categories-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Article</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $index => $comment)
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Adding the comment number -->
                <td>{{ $comment->username }}</td>
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->article->title }}</td>
                <td>
                    @if ($comment->status == 1)
                    <button type="button" class="btn btn-success">Approved</button>
                    @else
                    <button type="button" class="btn btn-warning">Pending</button>
                    @endif
                </td>
                <td>
                    @if (!$comment->status)
                    <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">Approve</button>
                    </form>
                    @endif
                    <!-- Add the delete form here as you requested -->
                    <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No comments found.</p>
    @endif
</div>
@endsection
