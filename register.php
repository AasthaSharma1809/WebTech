<?php
session_start();  // Start the session to store user details

header("Content-Type: application/json");

// Load existing users from JSON file
$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

// Get data from the POST request
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if email is already registered
foreach ($users as $user) {
    if ($user['email'] === $email) {
        echo json_encode(["success" => false, "message" => "Email already registered!"]);
        exit;
    }
}

// Add new user to the list
$users[] = ['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password];
file_put_contents($usersFile, json_encode($users));

// Store user data in session for later display on the confirmation page
$_SESSION['user'] = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'gender' => $_POST['gender']
];

echo json_encode(["success" => true, "message" => "Registration successful!"]);
?>
