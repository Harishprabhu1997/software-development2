<?php
session_start();
require_once('config.php');

// Check if book id is provided
if (!isset($_GET['id'])) {
    $_SESSION['error'] = "Book ID not provided.";
    header("Location: index.php");
    exit();
}

$book_id = $_GET['id'];

// Get book information from database
$stmt = $pdo->prepare("SELECT * FROM books WHERE id=:id");
$stmt->execute(['id' => $book_id]);
$book = $stmt->fetch();

// Get user information if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Check if user has purchased the book
    $stmt = $pdo->prepare("SELECT * FROM purchases WHERE user_id=:user_id AND book_id=:book_id");
    $stmt->execute(['user_id' => $user_id, 'book_id' => $book_id]);
    $purchase = $stmt->fetch();
}

?>
<!-- HTML page for displaying book information -->
<h1><?php echo $book['title']; ?></h1>
<p>Author: <?php echo $book['author']; ?></p>
<p>Genre: <?php echo $book['genre']; ?></p>
<p>Language: <?php echo $book['language']; ?></p>
<p>Price: <?php echo $book['price']; ?></p>
<?php if (isset($purchase)) : ?>

<!-- Display audio player for purchased book -->
<!-- Code for audio player goes here -->
<?php else : ?>
<?php if (isset($_SESSION['user_id'])) : ?>
    <!-- Display purchase button for logged in users -->
    <!-- Code for purchase button goes here -->
<?php else : ?>
    <!-- Display login button for non-logged in users -->
    <!-- Code for login button goes here -->
<?php endif; ?>
<?php endif; ?>