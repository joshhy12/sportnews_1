// comments.js

// Wait for the document to be ready
document.addEventListener('DOMContentLoaded', function() {
  // Get the comment form element
  var commentForm = document.getElementById('comment-form');

  // Add a submit event listener to the comment form
  commentForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Disable the submit button while the comment is being submitted
    var submitButton = commentForm.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    // Get the comment data from the form
    var formData = new FormData(commentForm);

    // Send a POST request to the server to add the comment
    fetch(commentForm.action, {
      method: 'POST',
      body: formData
    })
    .then(function(response) {
      // Re-enable the submit button
      submitButton.disabled = false;

      if (response.ok) {
        // Comment was added successfully
        commentForm.reset(); // Reset the form
        showSuccessMessage('Comment added successfully. Waiting for admin approval.');
      } else {
        // There was an error adding the comment
        showErrorMessage('Failed to add comment. Please try again.');
      }
    })
    .catch(function(error) {
      // Re-enable the submit button
      submitButton.disabled = false;

      // Display an error message
      showErrorMessage('An error occurred. Please try again later.');
    });
  });

  // Function to show a success message
  function showSuccessMessage(message) {
    var successAlert = document.getElementById('success-alert');
    successAlert.innerText = message;
    successAlert.style.display = 'block';
  }

  // Function to show an error message
  function showErrorMessage(message) {
    var errorAlert = document.getElementById('error-alert');
    errorAlert.innerText = message;
    errorAlert.style.display = 'block';
  }
});
