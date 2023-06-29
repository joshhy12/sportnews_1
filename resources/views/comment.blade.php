<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="article_id" value="{{ $article->id }}">
    <textarea name="content" placeholder="Write your comment here" required></textarea>
    <button type="submit">Submit Comment</button>
</form>
