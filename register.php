<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>

        <!-- Registration Form -->
        <?php if ($_SERVER['REQUEST_METHOD'] != 'POST'): ?>
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
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
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
    </div>
</body>
</html>
