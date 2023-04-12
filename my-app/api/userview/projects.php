<?php
require_once __DIR__ . '/conn.php';

// Fetch a user about section
$user_id = $user_ID;
$stmt = $conn->prepare("SELECT edu.projectName, edu.projectDesc FROM tbl_Users us JOIN tbl_Users_Projects usedu ON us.user_ID = usedu.user_ID_pk_fk JOIN tbl_Projects edu ON edu.project_ID = usedu.project_ID_pk_fk WHERE us.user_ID = ?;");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Output the quote
if ($result->num_rows === 0) {
    echo '<div class="university">';
    echo '<h3 class="user-details pt-2 pb-2">Emptyness</h3>';
    echo '</div>';
} else {
    while ($row = $result->fetch_assoc()) {

        echo '<div class="profile-project mb-1">';
        echo '<h3 class="user-details mt-1">' . $row["projectName"] . '</h3>';
        echo '<p class="certificate mb-0">' . $row["projectDesc"] . '</p>';
        echo '</div>';
    }
}
