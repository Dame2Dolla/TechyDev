<?php
require_once __DIR__ . '/conn.php';
require_once __DIR__ . '/session.php';

// Fetch a user about section
$user_id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT us.givenName, us.familyName, edu.institutionName FROM tbl_Users us LEFT JOIN tbl_Users_Educations usedu ON us.user_ID = usedu.user_ID_pk_fk LEFT JOIN tbl_Educations edu ON edu.education_ID = usedu.education_ID_pk_fk WHERE us.user_ID = ? ORDER BY edu.is_ongoing DESC, edu.date_end DESC;");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Output the quote
if ($result->num_rows > 0) {
    echo '<h2>' . $row["givenName"] . ' ' . $row["familyName"] . '</h2>';
    if (!empty($row["institutionName"])) {
        echo '<p class="text-school">Student at ' . $row["institutionName"] . '</p>';
    } else {
        echo '<p class="text-school">Not a Student</p>';
    }
} else {
    echo '<h2>Default Name</h2>';
    echo '<p>Student at Default</p>';
}
