<?php
session_start();

// Check if form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process registration
    header("Content-Type: application/json");

    $usersFile = 'users.json';
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

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

    // Return JSON response
    echo json_encode(["success" => true, "message" => "Registration successful!"]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
