<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Connect to the database
$db = new mysqli('localhost', 'username', 'password', 'audio_book_db');
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Get the user's cart items from the database
$user_id = $_SESSION['user_id'];
$cart_query = "SELECT * FROM cart WHERE user_id = $user_id";
$cart_result = $db->query($cart_query);

// Calculate the total price of the items in the cart
$total_price = 0;
while ($cart_row = $cart_result->fetch_assoc()) {
    $book_id = $cart_row['book_id'];
    $book_query = "SELECT * FROM books WHERE book_id = $book_id";
    $book_result = $db->query($book_query);
    $book_row = $book_result->fetch_assoc();
    $book_price = $book_row['price'];
    $total_price += $book_price;
}

// Process the payment
if (isset($_POST['submit'])) {
    $card_number = $_POST['card_number'];
    $expiry_month = $_POST['expiry_month'];
    $expiry_year = $_POST['expiry_year'];
    $cvv = $_POST['cvv'];

    // TODO: Implement payment processing code here

    // Clear the user's cart after successful payment
    $clear_query = "DELETE FROM cart WHERE user_id = $user_id";
    $db->query($clear_query);

    // Redirect the user to the account page
    header('Location: account.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <p>Total price: <?php echo $total_price; ?></p>
    <form method="post">
        <label for="card_number">Card number:</label>
        <input type="text" name="card_number" required>
        <br>
        <label for="expiry_month">Expiry month:</label>
        <input type="number" name="expiry_month" min="1" max="12" required>
        <br>
        <label for="expiry_year">Expiry year:</label>
        <input type="number" name="expiry_year" min="2023" max="2050" required>
        <br>
        <label for="cvv">CVV:</label>
        <input type="text" name="cvv" required>
        <br>
        <input type="submit" name="submit" value="Pay">
    </form>
</body>
</html>
