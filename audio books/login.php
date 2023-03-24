<?php
session_start(); // start a new session
// require_once('db.php'); // include the database connection file
// database connection
$db_host = 'localhost'; // replace with your database host
$db_name = 'audio_books'; // replace with your database name
$db_user = 'phpmyadmin'; // replace with your username
$db_pass = '1412'; // replace with your password
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
  die('Could not connect to the database: ' . mysqli_connect_error());
}


if(isset($_POST['login'])) {
  // sanitize and store the form data in variables
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // search for the user with the given email and password
  $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result) == 1) {
    // if the user is found, store the user data in the session and redirect to the homepage
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    header('Location: index.php');
    exit();
  } else {
    // if the user is not found, display an error message
    $error = 'Invalid email or password. Please try again.';
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Audio Books</title>
</head>
<body>
  <h1>Login</h1>
  <?php if(isset($error)) echo '<p>' . $error . '</p>'; ?>
  <form method="post" action="">
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <button type="submit" name="login">Login</button>
  </form>
</body>
</html>
``
