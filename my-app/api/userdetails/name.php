<?php
require_once __DIR__ . '/conn.php';



// Fetch a user about section
$user_id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM tbl_Users WHERE user_ID = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Output the quote
if ($result->num_rows > 0) {
    echo '<h1 class="text-name">' . $row["givenName"] . ' '  . $row["middleName"] . ' ' . $row["familyName"] . '</h1>';
} else {
    echo '<h1 class="text-name">Database error, please contact customer service.</h1>';
}
