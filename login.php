<?php
header("Content-Type: application/json");

// Load existing users from JSON file
$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

// Get data from the POST request
$email = $_POST['email'];
$password = $_POST['password'];

// Check credentials
foreach ($users as $user) {
    if ($user['email'] === $email && password_verify($password, $user['password'])) {
        echo json_encode(["success" => true, "message" => "Logged in successfully!"]);
        exit;
    }
}

echo json_encode(["success" => false, "message" => "Invalid email or password."]);
?>
