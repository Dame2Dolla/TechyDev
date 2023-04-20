<?php
require __DIR__ . "/../conn.php";



// Fetch a user about section
$user_id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM tbl_Users WHERE user_ID = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Output the quote
if ($result->num_rows > 0 && $row["bio_desc"] != "") {
    echo '<p class="user-details">' . $row["bio_desc"] . '</p>';
} else {
    echo '<p class="user-details">Emptyness...</p>';
}
