$(function() {
    // Get the server's current time in UTC
    var serverTime = new Date("{{ now()->toJSON() }}");

    // Convert the server time to the local time zone
    var localTime = serverTime.toLocaleString("en-US", {
        timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone
    });

    // Set the local time in the published_at field
    document.getElementById('published_at').value = localTime.slice(0, 16);

    // Get the input field
    var inputField = document.getElementById('published_at');

    // Add event listener for hover
    inputField.addEventListener('mouseover', function() {
        // Get the current date and time from the input field
        var currentDateTime = inputField.value;

        // Set the tooltip text to the current date and time
        inputField.title = currentDateTime;
    });
});
