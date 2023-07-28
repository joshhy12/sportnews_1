@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Article</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <div id="contentEditor">{!! $article->content !!}</div>
            <textarea id="content" name="content" style="display: none;" required></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category_id" class="form-control">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @if($category->id === $article->category_id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="author_id" value="{{ $article->author_id }}">
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image_url" name="image">
        </div>
        <div class="form-group">
            <label for="published_at">Published At</label>
            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d\TH:i') : '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Article</button>
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




    // Initialize the editor after the document is loaded
    document.addEventListener("DOMContentLoaded", function() {
        const editorInstance = $('#contentEditor').dxHtmlEditor({
            // ... (your other options)
        }).dxHtmlEditor('instance');

        // Set the initial content of the editor
        editorInstance.option("value", document.getElementById('content').value);

        // Update the hidden textarea when the editor's content changes
        editorInstance.on("valueChanged", function(e) {
            $('#content').val(e.value);
        });
    });
</script>
@endsection
