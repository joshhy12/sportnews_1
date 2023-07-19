@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Create Article</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <div id="contentEditor"></div>
            <textarea id="content" name="content" style="display: none;" required></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category_id" class="form-control" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="published_at">Published At</label>
            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ now()->format('Y-m-d\TH:i') }}">
        </div>
        <button type="submit" class="btn btn-primary">Create Article</button>
    </form>
</div>

<script>
    // Get the server's current time in UTC
    var serverTime = new Date("{{ now()->toJSON() }}");

    // Convert the server time to the local time zone
    var localTime = serverTime.toLocaleString("en-US", {
        timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone
    });

    // Set the local time in the published_at field
    document.getElementById('published_at').value = localTime.slice(0, 16);


    // Get the input field
    var titleInput = document.getElementById('title');

    // Add event listener for input
    titleInput.addEventListener('input', function() {
        // Get the entered text
        var enteredText = titleInput.value;

        // Convert the text to uppercase
        var uppercaseText = enteredText.toUpperCase();

        // Set the uppercase text as the value of the input field
        titleInput.value = uppercaseText;
    });
</script>

@endsection
