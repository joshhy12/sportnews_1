@extends('layouts.admin')

@section('content')
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link href="{{ asset('css/users.css') }}" rel="stylesheet">
<!--<link href="{{ asset('css/footer.css') }}" rel="stylesheet">-->
<script src="{{ asset('JavaScript/myScript.js') }}"></script>

</link>
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1>All Users</h1>

    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">{{ __('Add User') }}</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Admin</th> <!-- New column for the admin button -->
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
            $count = 1;
            @endphp
            @foreach($users as $user)
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    @if ($user->isAdmin)
                        <button type="button" class="btn btn-success">Admin</button>
                    @else
                        <button type="button" class="btn btn-warning">Not Admin</button>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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
