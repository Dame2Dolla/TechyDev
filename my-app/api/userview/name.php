<?php

require_once __DIR__ . '/conn.php';

$user_id = $user_ID;
// Fetch a user about section
$stmt = $conn->prepare("SELECT * FROM tbl_Users us LEFT JOIN tbl_Users_Educations usedu ON us.user_ID = usedu.user_ID_pk_fk LEFT JOIN tbl_Educations edu ON edu.education_ID = usedu.education_ID_pk_fk WHERE us.user_ID = ? ORDER BY usedu.is_ongoing DESC, usedu.date_end DESC;");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Output the quote
if ($result->num_rows > 0) {
    echo '<h1 class="text-name">' . $row["givenName"] . ' '  . $row["middleName"] . ' ' . $row["familyName"] . '</h1>';
    if (!empty($row["institutionName"])) {
        echo '<p class="text-school">' . $row["institutionName"] . '</p>';
    } else {
        echo '<p class="text-school">Not a Student</p>';
    }
} else {
    echo '<h1 class="text-name">Database error, please contact customer service.</h1>';
    echo '<p class="text-school">Error</p>';
}
