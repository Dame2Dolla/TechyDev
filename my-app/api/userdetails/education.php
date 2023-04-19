<?php
require_once __DIR__ . '/conn.php';

// // Fetch a user about section
$user_id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT edu.education_ID, edu.institutionName, edu.courseTitle, usedu.date_start, usedu.date_end, usedu.is_ongoing FROM tbl_Users us JOIN tbl_Users_Educations usedu ON us.user_ID = usedu.user_ID_pk_fk JOIN tbl_Educations edu ON edu.education_ID = usedu.education_ID_pk_fk WHERE us.user_ID = ? ORDER BY usedu.is_ongoing DESC, usedu.date_end DESC;");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Output the quote
if ($result->num_rows === 0) {
    echo '<div class="university">';
    echo '<h3 class="user-details pt-2">Emptyness</h3>';
    echo '</div>';
} else {
    while ($row = $result->fetch_assoc()) {
        // Format start date
        $startDate = new DateTime($row["date_start"]);
        $formattedStartDate = $startDate->format('M d');

        // Format end date (if not ongoing)
        $endDate = $row["is_ongoing"] == 1 ? 'ongoing' : (new DateTime($row["date_end"]))->format('M d');

        // Output the university div section with formatted dates
        echo '<div class="university">';
        echo '<h3 class="user-details pt-2">' . $row["institutionName"] . '</h3>';
        echo '<h4 class="certificate">' . $row["courseTitle"] . '</h4>';
        echo '<p class="normal-text">' . $formattedStartDate . ' - ' . $endDate . '</p>';
        echo '</div>';
    }
}
