<!-- payment page -->
<!DOCTYPE html>
<html>
<head>
    <title>Payment - Audio Book Website</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<!-- cashout page form to pay using either paypal or credit -->
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="booklist.php">Audio Books</a></li>
                <li><a href="library.php">My Library</a></li>
                <li><a href="account.php">Account</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Payment</h1>
        <form action="process_payment.php" method="POST">
            <label for="card_number">Card Number:</label>
            <input type="text" name="card_number" id="card_number" required>
            <br>
            <label for="card_name">Name on Card:</label>
            <input type="text" name="card_name" id="card_name" required>
            <br>
            <label for="card_expiry">Expiry Date:</label>
            <input type="text" name="card_expiry" id="card_expiry" required>
            <br>
            <label for="card_cvv">CVV:</label>
            <input type="text" name="card_cvv" id="card_cvv" required>
            <br>
            <input type="submit" value="Pay">
        </form>
    </main>

    <footer>
        <p>&copy; 2023 Audio Books Website. All rights reserved.</p>
    </footer>
</body>
</html>

