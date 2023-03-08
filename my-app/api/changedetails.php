<?php

require_once __DIR__ . '/conn.php';

require "./functionsForApi/functions.php";

// Fetching the data send from the changedetails.js
$firstName = postCleanForText(isset($_POST['firstName']) ? $_POST['firstName'] : "");
$lastName = postCleanForText(isset($_POST['lastName']) ? $_POST['lastName'] : "");
$csrf_token = $_POST['token'];
$userId = $_SESSION['id_user'];

// Aquire session date_expire and add 60 minutes
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {
    
    //Update SQL
    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
    $stmt->execute();
    $stmt->get_result();
    if (!empty($firstName)) {

        // Update statement
        //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
        $stmt = $conn->prepare("UPDATE tbl_Users set givenName = ? WHERE userID = ?");
        $stmt->bind_param("ss", $firstName,  $userId);
        $stmt->execute();
        $stmt->get_result();
    }

    if (!empty($lastName)) {

        // Update statement
        //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
        $stmt = $conn->prepare("UPDATE tbl_Users set familyName = ? WHERE userID = ?");
        $stmt->bind_param("ss", $lastName,  $userId);
        $stmt->execute();
        $stmt->get_result();
    }

    // Remove safe update to protect the database from any manipulation.
    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
    $stmt->execute();
    $stmt->get_result();

    echo"Successful";
} else {
    echo "bad token";
}
?>