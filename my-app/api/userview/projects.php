<?php
require __DIR__ . "/../conn.php";

// Fetch a user about section
$user_id = $user_ID;
$stmt = $conn->prepare("SELECT edu.projectName, edu.projectDesc, edu.is_ongoing as ongoing, edu.date_end FROM tbl_Users us JOIN tbl_Users_Projects usedu ON us.user_ID = usedu.user_ID_pk_fk JOIN tbl_Projects edu ON edu.project_ID = usedu.project_ID_pk_fk WHERE us.user_ID = ?;");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Output the quote
if ($result->num_rows === 0) {
    echo '<div class="university">';
    echo '<h3 class="user-details pt-2 pb-2">Emptyness...</h3>';
    echo '<p>Complete</p>';
    echo '</div>';
} else {
    while ($row = $result->fetch_assoc()) {
        if ($row["ongoing"] == 1) {
            $status = "Ongoing";
        } else {
            $formattedDateEnd = (new DateTime($row["date_end"]))->format('Y-m-d');
            $status = "Completed on: " . $formattedDateEnd;
        }

        echo '<div class="profile-project mb-1">';
        echo '<h3 class="user-details mt-1">' . $row["projectName"] . '</h3>';
        echo '<p class="certificate mb-1">' . $row["projectDesc"] . '</p>';
        echo '<p class="normal-text">Status: ' . $status . '</p>';
        echo '</div>';
    }
}
