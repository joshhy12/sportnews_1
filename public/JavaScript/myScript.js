// Initialize Bootstrap dropdown menu
var dropdownElements = document.querySelectorAll('.dropdown-toggle');
dropdownElements.forEach(function(element) {
    new bootstrap.Dropdown(element);
});
