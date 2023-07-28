@extends('layouts.admin')

@section('content')
<div class="container">
<h1>Approved Comments</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($approvedComments->count() > 0)
        @foreach ($approvedComments as $comment)
            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->username }}</h5>
                    <p class="card-text">{{ $comment->content }}</p>
                    <p class="card-text"><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                    <span class="badge badge-success">Approved</span>
                    <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p>No approved comments available.</p>
    @endif
</div>
@endsection
