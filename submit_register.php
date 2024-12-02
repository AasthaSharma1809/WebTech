<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Read existing users from the file
    $data = file_get_contents('users.json');
    $users = json_decode($data, true);

    if (!$users) {
        $users = [];
    }

    if (isset($users[$email])) {
        echo "Email already exists. Please use a different email.";
    } else {
        $users[$email] = [
            'name' => $name,
            'password' => $password
        ];

        // Save updated user data back to the file
        file_put_contents('users.json', json_encode($users));

        echo "Registration successful!";
        header("Location: login.html");
        exit();
    }
}
?>
