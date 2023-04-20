<?php
require __DIR__ . "/../session.php";
require __DIR__ . "/../conn.php";
require "../functionsForApi/functions.php";

$user_id = $_SESSION['id_user'];
$educationID = postCleanForNumber(isset($_POST['educationID']) ? $_POST['educationID'] : "");
$universityEdit = postCleanForText(isset($_POST['universityEdit']) ? $_POST['universityEdit'] : "");
$certificateEdit = postCleanForText(isset($_POST['certificateEdit']) ? $_POST['certificateEdit'] : "");
$startDateEdit = postCleanForTextAndNumbers(isset($_POST['startDateEdit']) ? $_POST['startDateEdit'] : "");
$endDateEdit = postCleanForTextAndNumbers(isset($_POST['endDateEdit']) ? $_POST['endDateEdit'] : "");
$ongoingEdit = filter_var($_POST["ongoingEdit"], FILTER_VALIDATE_BOOLEAN);

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

    if ($ongoingEdit) {
        // Update statement
        //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
        $stmt = $conn->prepare("UPDATE tbl_Users_Educations set date_start = ?, date_end = NULL, is_ongoing = 1 WHERE education_ID_pk_fk = ? AND user_ID_pk_fk  = ?");
        $stmt->bind_param("sii", $startDateEdit, $educationID, $user_id);
        $stmt->execute();
        $stmt->get_result();
    } else {
        // Update statement
        //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
        $stmt = $conn->prepare("UPDATE tbl_Users_Educations set date_start = ?, date_end = ?, is_ongoing = 0 WHERE education_ID_pk_fk = ? AND user_ID_pk_fk  = ?");
        $stmt->bind_param("ssii", $startDateEdit, $endDateEdit, $educationID, $user_id);
        $stmt->execute();
        $stmt->get_result();
    }

    // Remove safe update to protect the database from any manipulation.
    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
    $stmt->execute();

    echo "Complete";

    $stmt->close();
} else {
    echo "bad token";
}
$conn->close();
