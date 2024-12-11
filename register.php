<?php
header("Content-Type: text/html; charset=UTF-8");

// Load existing users from JSON file
$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

$registrationSuccess = false;
$userDetails = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email is already registered
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $errorMessage = "Email already registered!";
            break;
        }
    }

    // If email is not already registered, add new user
    if (!isset($errorMessage)) {
        $users[] = ['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password];
        file_put_contents($usersFile, json_encode($users));

        $registrationSuccess = true;
        $userDetails = ['name' => $name, 'email' => $email, 'phone' => $phone];
    }
}
?>
