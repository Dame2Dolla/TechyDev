<?php
require "../session.php";
require "../conn.php";
require "../functionsForApi/functions.php";
require_once __DIR__ . '/session.php';

$user_id = $_SESSION['id_user'];
$projectName = postCleanForText(isset($_POST['projectName']) ? $_POST['projectName'] : "");
$projectDesc = postCleanForText(isset($_POST['projectDesc']) ? $_POST['projectDesc'] : "");
$ongoing = filter_var($_POST["ongoing"], FILTER_VALIDATE_BOOLEAN);

if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
    echo "bad token";
    exit;
}

$_SESSION['date_expire'] = time();
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
$csrf_token = $_POST['token'];
if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {

    // Insert education data into tbl_Projects
    $sql = "INSERT INTO tbl_Projects (projectName, projectDesc,  is_ongoing) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $projectName, $projectDesc, $ongoing);
    $result = $stmt->execute();



    if ($result) {
        // Get the last inserted education id using LAST_INSERT_ID()
        $sql = "SELECT LAST_INSERT_ID() as project_ID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $project_ID = $row['project_ID'];

        // Insert user-education mapping into tbl_Users_Educations
        $sql = "INSERT INTO tbl_Users_Projects (user_ID_pk_fk, project_ID_pk_fk) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $project_ID);
        $stmt->execute();
        echo "Complete";
    } else {
        echo "Error";
    }


    $stmt->close();
} else {
    echo "bad token";
}
$conn->close();
