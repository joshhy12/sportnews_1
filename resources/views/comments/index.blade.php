@extends('layouts.home')

@section('content')
    <div class="container">
        <h1>Comments</h1>
        @foreach ($comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                    <p class="card-text">{{ $comment->content }}</p>
                    @if ($comment->approved)
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending Approval</span>
                    @endif
                    <form action="{{ route('comments.approve', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                    </form>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
