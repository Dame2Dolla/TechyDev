<?php

require "../conn.php";
require "../functionsForApi/functions.php";
require "../session.php";



//Sanitize, filtering & ESCAPE

$email = postCleanForTextAndNumbers($_POST['email']);
$user_id = $_SESSION['id_user'];

if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
    echo "bad token";
    exit;
}
$_SESSION['date_expire'] = time();
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
$csrf_token = $_POST['token'];

if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {

    //----------------------------------------------------Update password count -1 --------------------------------------------
    // remove Safe update from MySQL to implement an update sql statement.
    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
    $stmt->execute();
    $stmt->get_result();

    // Update statement
    // To prevent SQL injections, we use prepared statements with bound parameters.
    $stmt = $conn->prepare("UPDATE tbl_Users SET email = ? WHERE user_ID = ?");
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();

    // Remove safe update to protect the database from any manipulation.
    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
    $stmt->execute();
    $stmt->get_result();

    echo "Complete";

    $stmt->close();
} else {
    echo "bad token";
}
$conn->close();
