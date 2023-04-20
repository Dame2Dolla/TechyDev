<?php
require __DIR__ . "/../session.php";
require __DIR__ . "/../conn.php";
require "../functionsForApi/functions.php";

$user_id = $_SESSION['id_user'];
$projectId = postCleanForNumber(isset($_POST['projectId']) ? $_POST['projectId'] : "");
$projectNameEdit = postCleanForText(isset($_POST['projectNameEdit']) ? $_POST['projectNameEdit'] : "");
$projectDescEdit = postCleanForText(isset($_POST['projectDescEdit']) ? $_POST['projectDescEdit'] : "");
$ongoingEdit = filter_var($_POST["projectOngoingEdit"], FILTER_VALIDATE_BOOLEAN);

if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
    echo "bad token";
    exit;
}

$_SESSION['date_expire'] = time();
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
$csrf_token = $_POST['token'];
if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {

    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
    $stmt->execute();
    $stmt->get_result();

    // Update statement
    //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
    $stmt = $conn->prepare("UPDATE tbl_Projects set projectName = ?, projectDesc = ?, is_ongoing = ?  WHERE project_ID = ?");
    $stmt->bind_param("sssi", $projectNameEdit, $projectDescEdit, $ongoingEdit, $projectId);
    $stmt->execute();
    $stmt->get_result();

    // Remove safe update to protect the database from any manipulation.
    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
    $stmt->execute();

    echo "Complete";

    $stmt->close();
} else {
    echo "bad token";
}
$conn->close();
