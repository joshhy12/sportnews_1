<form action="{{ route('comment.store') }}" method="POST">
    @csrf

    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="comment">Comment:</label>
    <textarea name="comment" required></textarea><br>

    <button type="submit">Submit</button>
</form>
