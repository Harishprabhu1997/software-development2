<?php
session_start();
require_once('config.php');

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please log in.";
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user information from database
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id=:id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

?>
<!-- HTML page for user account -->
<h1>My Account</h1>
<p>Name: <?php echo $user['name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<h2>My Library</h2>
<!-- Display user's audio books and playlists -->
<!-- Code for displaying user's audio books and playlists goes here -->
<h2>Settings</h2>
<!-- HTML form for changing user's password -->
<form action="changepassword.php" method="post">
    <label for="oldpassword">Old Password:</label>
    <input type="password" name="oldpassword" required>
python
Copy code
<label for="newpassword">New Password:</label>
<input type="password" name="newpassword" required>

<input type="submit" value="Change Password">
</form>
<!-- HTML form for deleting user's account -->
<form action="deleteaccount.php" method="post">
    <label for="password">Confirm Password:</label>
    <input type="password" name="password" required>
python
Copy code
<input type="submit" value="Delete Account">
</form>