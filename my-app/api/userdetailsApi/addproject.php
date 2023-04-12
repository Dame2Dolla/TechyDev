<?php
require "../session.php";
require "../conn.php";
require "../functionsForApi/functions.php";


$user_id = $_SESSION['id_user'];
$projectName = postCleanForText(isset($_POST['projectName']) ? $_POST['projectName'] : "");
$projectDesc = postCleanForText(isset($_POST['projectDesc']) ? $_POST['projectDesc'] : "");
$ongoing = filter_var($_POST["ongoing"], FILTER_VALIDATE_BOOLEAN);

if ($ongoing) {
    // Insert education data into tbl_Educations
    $sql = "INSERT INTO tbl_Educations (institutionName, courseTitle, date_start, is_ongoing) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $university, $certificate, $startdate, $ongoing);
    $result = $stmt->execute();
} else {
    // Insert education data into tbl_Educations
    $sql = "INSERT INTO tbl_Educations (institutionName, courseTitle, date_start, date_end, is_ongoing) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $university, $certificate, $startdate, $enddate, $ongoing);
    $result = $stmt->execute();
}


if ($result) {
    // Get the last inserted education id using LAST_INSERT_ID()
    $sql = "SELECT LAST_INSERT_ID() as education_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $education_id = $row['education_id'];

    // Insert user-education mapping into tbl_Users_Educations
    $sql = "INSERT INTO tbl_Users_Educations (user_ID_pk_fk, education_ID_pk_fk) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $education_id);
    $stmt->execute();
    echo "Complete";
}


$stmt->close();
$conn->close();
