@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Approve Comment</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Comment Details</h5>
                <p><strong>Name:</strong> {{ $comment->name }}</p>
                <p><strong>Email:</strong> {{ $comment->email }}</p>
                <p><strong>Comment:</strong> {{ $comment->content }}</p>
                <p><strong>Article:</strong> {{ $comment->article->title }}</p>
                <p><strong>Status:</strong> {{ $comment->approved ? 'Approved' : 'Pending' }}</p>
            </div>
        </div>

        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Approve Comment</button>
        </form>
    </div>
@endsection
