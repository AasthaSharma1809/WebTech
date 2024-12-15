<?php
// Start the session
session_start();

// Initialize message variable
$message = "";

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Redirect to a logged-in page or show a success message
    header("Location: dashboard.php");  // Redirect to another page (e.g., dashboard.php)
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if email and password are set before using them
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Load users data
        $usersData = file_get_contents('users.json');
        $users = json_decode($usersData, true);

        // Check for user credentials
        $userFound = false;
        foreach ($users as $user) {
            if ($user['email'] == $email && password_verify($password, $user['password'])) {
                // User is found and credentials are correct
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user;  // Store user info in the session
                $message = "Login successful!";
                // Redirect to the dashboard or user page
                header("Location: dashboard.php");
                exit();
            }
        }

        if (!$userFound) {
            $message = "Invalid email or password!";
        }
    } else {
        $message = "Please fill in both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <!-- Show message (if any) -->
        <p><?php echo $message; ?></p>

        <!-- Login Form -->
        <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false): ?>
            <form method="POST" action="login.php">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" value="Login">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
