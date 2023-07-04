// comments.js
document.getElementById('comment-form').addEventListener('submit', function (event) {
    event.preventDefault();

    var formData = new FormData(this);
    var articleId = this.getAttribute('data-article-id');

    fetch('/comments', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(function (data) {
        // Handle success response
        var successElement = document.getElementById('comment-success');
        successElement.style.display = 'block';
        successElement.textContent = data.message;

        // Clear the form
        document.getElementById('username').value = '';
        document.getElementById('content').value = '';

        // Display the new comment
        var commentsContainer = document.getElementById('comments-container');
        var commentDiv = document.createElement('div');
        commentDiv.classList.add('card', 'mt-2');
        commentDiv.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">${data.comment.username}</h5>
                <p class="card-text">${data.comment.content}</p>
            </div>
        `;
        commentsContainer.appendChild(commentDiv);
    })
    .catch(function (error) {
        // Handle error response
        var errorElement = document.getElementById('comment-error');
        errorElement.style.display = 'block';
        errorElement.textContent = 'Error: ' + error.message;
    });
});
