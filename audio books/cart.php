<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if a book ID was provided
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

// Connect to the database
$db_host = 'localhost';
$db_name = 'audio_books';
$db_user = 'username';
$db_pass = 'password';
$db_conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

// Retrieve the book information from the database
$stmt = $db_conn->prepare('SELECT * FROM books WHERE id = :id');
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the book exists
if (!$book) {
    header('Location: index.php');
    exit();
}

// Add the book to the cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$_SESSION['cart'][] = $book['id'];

// Redirect to the cart page
header('Location: view_cart.php');
exit();
