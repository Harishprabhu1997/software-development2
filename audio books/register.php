<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists in database
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email=:email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['error'] = "Email address already registered. Please log in.";
        header("Location: login.php");
        exit();
    }

    // Insert user into database
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

    // Redirect to login page
    $_SESSION['success'] = "Registration successful. Please log in.";
    header("Location: login.php");
    exit();
}
?>
<!-- HTML form for user registration -->
<form action="register.php" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" required>
ruby
Copy code
<label for="email">Email:</label>
<input type="email" name="email" required>

<label for="password">Password:</label>
<input type="password" name="password" required>

<input type="submit" value="Register">
</form>
