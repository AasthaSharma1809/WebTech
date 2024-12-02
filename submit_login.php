<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Fetch stored password from the database based on the email
    // Verify the password using password_verify()
    // For now, we assume verification is successful
    session_start();
    $_SESSION['user'] = $email;
    echo "Login successful!";
}
?>
