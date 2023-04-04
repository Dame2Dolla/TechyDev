<?php
require_once __DIR__ . '/conn.php';

// Fetch a random quote
$stmt = $conn->prepare("SELECT * FROM tbl_Quotes ORDER BY RAND() LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();

// Output the quote
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<div class="quotes">';
    echo '<p class="quote-text">' . $row["text"] . '</p>';
    echo '<p class="quoter-text">' . $row["author"] . '</p>';
    echo '</div>';
} else {
    echo '<div class="quotes">';
    echo '<p class="quote-text">"Education is the most powerful weapon which you can use to change the world."</p>';
    echo '<p class="quoter-text"> - Nelson Mandela</p>';
    echo '</div>';
}

// Close connection
$conn->close();
