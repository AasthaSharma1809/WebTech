<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];  // You might want to hash the password for security
    $gender = $_POST['gender'];

    // Optionally: You can process the registration data, e.g., save it to a file/database.
    $usersData = file_get_contents('users.json');
    $users = json_decode($usersData, true);

    // Check if the email is already registered
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $message = 'Email already registered!';
            break;
        }
    }

    // If email is not already registered, add the new user to the data
    if (!isset($message)) {
        $newUser = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_DEFAULT),  // Hash password before saving
            'gender' => $gender
        ];
        $users[] = $newUser;
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

        $message = 'Registration successful!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>

        <!-- Display message or form based on the registration process -->
        <?php if ($_SERVER['REQUEST_METHOD'] != 'POST' || isset($message)): ?>
            <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

            <!-- Registration Form -->
            <?php if (!isset($message)): ?>
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
            <?php endif; ?>

            <!-- Show the user details after registration -->
            <?php if (isset($message) && $message == 'Registration successful!'): ?>
                <div id="userDetails">
                    <h2>Registration Successful!</h2>
                    <p>Name: <?php echo htmlspecialchars($name); ?></p>
                    <p>Email: <?php echo htmlspecialchars($email); ?></p>
                    <p>Phone: <?php echo htmlspecialchars($phone); ?></p>
                    <p>Gender: <?php echo htmlspecialchars($gender); ?></p>

                    <!-- Go back to registration -->
                    <a href="register.php"><button>Go Back to Registration Form</button></a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
