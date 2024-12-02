$(document).ready(function() {
    $('#registrationForm').submit(function(event) {
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();

        if (password !== confirmPassword) {
            alert('Passwords do not match.');
            event.preventDefault();
        }
    });
});
