@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Comments</h1>

        @if ($comments->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
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
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->article->title }}</td>
                            <td>
                                @if ($comment->approved)
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if (!$comment->approved)
                                    <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">Approve</button>
                                    </form>
                                @endif
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
