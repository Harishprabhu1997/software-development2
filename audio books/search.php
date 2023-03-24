<?php
// Include the database connection
include_once('includes/db_connect.php');

// Get the search query from the URL parameters
$search_query = $_GET['q'];

// Prepare the search query for use in a SQL LIKE statement
$search_query = '%' . $search_query . '%';

// Define the SQL query to search for audio books
$sql = "SELECT * FROM audio_books WHERE title LIKE ? OR author LIKE ? OR genre LIKE ? OR language LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$search_query, $search_query, $search_query, $search_query]);

// Fetch the results and display them in a table
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($results) > 0) {
    echo '<table>';
    echo '<tr><th>Title</th><th>Author</th><th>Genre</th><th>Language</th><th>Price</th><th>Sample</th><th>Buy</th></tr>';
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . $row['title'] . '</td>';
        echo '<td>' . $row['author'] . '</td>';
        echo '<td>' . $row['genre'] . '</td>';
        echo '<td>' . $row['language'] . '</td>';
        echo '<td>' . $row['price'] . '</td>';
        echo '<td><a href="' . $row['sample_url'] . '">Listen</a></td>';
        echo '<td><a href="buy.php?id=' . $row['id'] . '">Buy Now</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No results found.';
}
?>
