// JavaScript to handle form submission and other interactions
document.getElementById("registerForm").onsubmit = function(event) {
    // Prevent actual form submission
    event.preventDefault();
    // Perform your form validation or Ajax submission here
    window.location.href = "index.html"; // Redirect to login page after successful registration
};
