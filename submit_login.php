<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // Read user data from a JSON file
    $data = file_get_contents('users.json');
    $users = json_decode($data, true);

    if (isset($users[$email]) && password_verify($password, $users[$email]['password'])) {
        $_SESSION['user'] = $email;
        echo "Login successful!";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
