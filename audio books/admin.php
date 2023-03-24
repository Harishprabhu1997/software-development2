<?php
// Check if the user is logged in as an admin, otherwise redirect to login page
session_start();
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
  header('Location: login.php');
  exit();
}

// Connect to the database
$db_host = 'localhost';
$db_name = 'audio_books_db';
$db_user = 'username';
$db_pass = 'password';
$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$db_conn) {
  die('Could not connect to the database: ' . mysqli_connect_error());
}

// Handle POST requests to add a new audio book
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBook'])) {
  // Validate the input data (omitted for brevity)

  // Add the new audio book to the database
  $title = mysqli_real_escape_string($db_conn, $_POST['title']);
  $author = mysqli_real_escape_string($db_conn, $_POST['author']);
  $genre = mysqli_real_escape_string($db_conn, $_POST['genre']);
  $language = mysqli_real_escape_string($db_conn, $_POST['language']);
  $price = floatval($_POST['price']);
  $description = mysqli_real_escape_string($db_conn, $_POST['description']);
  $file_url = mysqli_real_escape_string($db_conn, $_POST['file_url']);
  $sql = "INSERT INTO books (title, author, genre, language, price, description, file_url) VALUES ('$title', '$author', '$genre', '$language', $price, '$description', '$file_url')";
  if (!mysqli_query($db_conn, $sql)) {
    echo 'Could not add the book to the database: ' . mysqli_error($db_conn);
  } else {
    echo 'Book added successfully!';
  }
}

// Handle GET requests to delete an audio book
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['deleteBook'])) {
  // Delete the audio book from the database
  $id = intval($_GET['deleteBook']);
  $sql = "DELETE FROM books WHERE id = $id";
  if (!mysqli_query($db_conn, $sql)) {
    echo 'Could not delete the book from the database: ' . mysqli_error($db_conn);
  } else {
    echo 'Book deleted successfully!';
  }
}

// Close the database connection
mysqli_close($db_conn);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Audio Books</title>
</head>
<body>
  <h1>Admin Panel</h1>

  <!-- Add a new audio book form -->
  <h2>Add a New Audio Book</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" required><br>
    <label for="author">Author:</label>
    <input type="text" name="author" required><br>
    <label for="genre">Genre:</label>
    <input type="text" name="genre" required><br>
    <label for="language">Language:</label>
    <input type="text" name="language" required><br>
    <label for="price">Price:</label>
    <input type="number" name="price" min="0" step="0.01" required><br>
    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>
    <label for="file_url">File URL:</label>
    <input type="url" name="file_url" required><br>
    <button type="submit" name="addBook">Add Book</button>
    </form>
</body>
<html> 