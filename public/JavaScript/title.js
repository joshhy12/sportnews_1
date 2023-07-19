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
