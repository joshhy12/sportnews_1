@extends('layouts.admin')

@section('content')

<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('css/footer.css') }}" rel="stylesheet">-->

    <!-- Scripts -->
    <script src="{{ asset('JavaScript/myScript.js') }}"></script>
    <!-- Latest compiled JavaScript -->

</link>


<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->name }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ $comment->comment }}</td>
                <td>
                    <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST">
                        @csrf
                        <button type="submit">Approve</button>
                    </form>
                    <form action="{{ route('admin.comments.decline', $comment->id) }}" method="POST">
                        @csrf
                        <button type="submit">Decline</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
