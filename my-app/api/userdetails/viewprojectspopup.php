<?php
require __DIR__ . "/../conn.php";

// Fetch a user about section
$user_id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT pjt.project_ID, pjt.projectName, pjt.projectDesc, pjt.date_end, pjt.is_ongoing as ongoing FROM tbl_Users us JOIN tbl_Users_Projects uspjt ON us.user_ID = uspjt.user_ID_pk_fk JOIN tbl_Projects pjt ON pjt.project_ID = uspjt.project_ID_pk_fk WHERE us.user_ID = ?;");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Output the quote
if ($result->num_rows === 0) {
    echo '<div class="popup-education-university-detail popupeducation-emptyness project-text-alignment mt-2">';
    echo   '<div>';
    echo '<h5 class="popup-education-university-name pl-1">Empty</h5>';
    echo '<p class="popup-education-university-text pl-1">Pending</p>';
    echo '</div>';
    echo '</div>';
} else {
    while ($row = $result->fetch_assoc()) {

        if ($row["ongoing"] == 1) {
            $status = "Ongoing";
        } else {
            $formattedDateEnd = (new DateTime($row["date_end"]))->format('Y-m-d');
            $status = "Completed on: " . $formattedDateEnd;
        }

        // Output the university div section with formatted dates
        echo '<div class="popup-education-university-detail project-text-alignment mt-2">';
        echo  '<img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" onclick="openEditProjectPopup(' . $row["project_ID"] . ', \'' . addslashes($row["projectName"]) . '\', \'' . addslashes($row["projectDesc"]) . '\', ' . ($row["ongoing"] == 1 ? 'true' : 'false') . ')" />';
        echo   '<div>';
        echo '<h5 class="popup-education-university-name pl-1">' . $row["projectName"] . '</h5>';
        echo '<p class="popup-education-university-text pl-1">Status: ' . $status . '</p>';
        echo '</div>';
        echo '</div>';
    }
}
