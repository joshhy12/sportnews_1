// comments.js

// Wait for the document to be ready
document.addEventListener('DOMContentLoaded', function () {
    // Get the comment form element
    var commentForm = document.querySelector('#comment-form');

    // Add an event listener for form submission
    commentForm.addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent the form from submitting

      // Get the form data
      var formData = new FormData(commentForm);

      // Perform any necessary validation here

      // Perform an AJAX request to submit the form data
      var xhr = new XMLHttpRequest();
      xhr.open('POST', commentForm.action);
      xhr.setRequestHeader('X-CSRF-TOKEN', commentForm.querySelector('input[name="_token"]').value);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Handle a successful response
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              // Clear the form fields
              commentForm.reset();
              // Display a success message or update the UI
              alert('Comment added successfully!');
            } else {
              // Handle a failed submission
              alert('Comment submission failed.');
            }
          } else {
            // Handle a non-200 HTTP status
            alert('Error: ' + xhr.status);
          }
        }
      };
      xhr.send(formData);
    });
  });
