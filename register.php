<?php
// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input data from the registration form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $gender = $_POST['gender'];

    // Define the file path to users.json
    $file_path = 'users.json';

    // Check if the users.json file exists and read the data
    if (file_exists($file_path)) {
        $users_data = file_get_contents($file_path);
        $users = json_decode($users_data, true); // Decode the JSON data into an associative array
    } else {
        // If the file doesn't exist, initialize an empty array
        $users = [];
    }

    // Check if the email already exists in the users data
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            // Display JSON response for email already exists
            echo '{"success": false, "message": "Email already registered!"}';
            exit;
        }
    }

    // Create the new user data array
    $new_user = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => $password,
        'gender' => $gender
    ];

    // Add the new user to the existing users array
    $users[] = $new_user;

    // Write the updated users array back to the users.json file
    file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));

    // Display registration success message
    echo '{"success": true, "message": "Registration successful!"}';

    // After success, display the registered user information
    echo "<h2>Registration Successful!</h2>";
    echo "<p>Name: " . htmlspecialchars($name) . "</p>";
    echo "<p>Email: " . htmlspecialchars($email) . "</p>";
    echo "<p>Phone: " . htmlspecialchars($phone) . "</p>";
    echo "<p>Gender: " . htmlspecialchars($gender) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>

<h1>Register</h1>

<form method="POST" action="register.php">
    <label for="name">Full Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="phone">Phone Number:</label><br>
    <input type="text" id="phone" name="phone" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label for="gender">Gender:</label><br>
    <input type="radio" id="male" name="gender" value="Male" required>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="Female" required>
    <label for="female">Female</label><br><br>

    <input type="submit" value="Register">
</form>

</body>
</html>
