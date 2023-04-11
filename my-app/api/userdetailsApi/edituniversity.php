<?php
require "../session.php";
require "../conn.php";
require "../functionsForApi/functions.php";


$user_id = $_SESSION['id_user'];
$educationID = postCleanForNumber(isset($_POST['educationID']) ? $_POST['educationID'] : "");
$universityEdit = postCleanForText(isset($_POST['universityEdit']) ? $_POST['universityEdit'] : "");
$certificateEdit = postCleanForText(isset($_POST['certificateEdit']) ? $_POST['certificateEdit'] : "");
$startDateEdit = postCleanForTextAndNumbers(isset($_POST['startDateEdit']) ? $_POST['startDateEdit'] : "");
$endDateEdit = postCleanForTextAndNumbers(isset($_POST['endDateEdit']) ? $_POST['endDateEdit'] : "");
$ongoingEdit = filter_var($_POST["ongoingEdit"], FILTER_VALIDATE_BOOLEAN);

$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
$stmt->execute();
$stmt->get_result();

if ($ongoingEdit) {
    // Update statement
    //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
    $stmt = $conn->prepare("UPDATE tbl_Educations set institutionName = ?, courseTitle = ?,date_start = ?, date_end = NULL, is_ongoing = 1 WHERE education_ID = ?");
    $stmt->bind_param("sssi", $universityEdit, $certificateEdit, $startDateEdit, $educationID);
    $stmt->execute();
    $stmt->get_result();
} else {
    // Update statement
    //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
    $stmt = $conn->prepare("UPDATE tbl_Educations set institutionName = ?, courseTitle = ?,date_start = ?, date_end = ?, is_ongoing = 0  WHERE education_ID = ?");
    $stmt->bind_param("ssssi", $universityEdit, $certificateEdit, $startDateEdit, $endDateEdit, $educationID);
    $stmt->execute();
    $stmt->get_result();
}

// Remove safe update to protect the database from any manipulation.
$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
$stmt->execute();

echo "Complete";

$stmt->close();
$conn->close();
