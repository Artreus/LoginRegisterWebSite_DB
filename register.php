<?php
require 'includes/db.php';
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long!";
        exit;
    }

    if (userExists($conn, $username, $email)) {
        echo "User with the same username or email already exists!";
        exit;
    } else {
        if (registerUser($conn, $username, $email, $password)) {
            echo "Registration successful!";
            exit;
        } else {
            echo "Registration failed!";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="register-form">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>