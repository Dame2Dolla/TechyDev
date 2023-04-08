<?php
require_once __DIR__ . '/conn.php';



// Fetch a user about section
$user_id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT edu.institutionName, edu.courseTitle, edu.date_start, edu.date_end, edu.is_ongoing FROM tbl_Users us JOIN tbl_Users_Educations usedu ON us.user_ID = usedu.user_ID_pk_fk JOIN tbl_Educations edu ON edu.education_ID = usedu.education_ID_pk_fk WHERE us.user_ID = ?;");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Output the quote
if ($result->num_rows === 0) {
    echo '<div class="university">';
    echo '<h3 class="user-details pt-2">Emptyness</h3>';
    echo '</div>';
} else {
    while ($row = $result->fetch_assoc()) {
        $endDate = $row["is_ongoing"] == 1 ? 'ongoing' : $row["date_end"];
        echo '<div class="university">';
        echo '<h3 class="user-details pt-2">' . $row["institutionName"] . '</h3>';
        echo '<h4 class="certificate">' . $row["courseTitle"] . '</h4>';
        echo '<p class="normal-text">' . $row["date_start"] . ' - ' . $endDate . '</p>';
        echo '</div>';
    }
}
