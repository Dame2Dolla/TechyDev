<?php
require "../conn.php";
require "../functionsForApi/functions.php";
require "../session.php";

$user_id = $_SESSION['id_user'];
$password = postCleanForPassword($_POST['password']);

if ($password != 'Password not properly formatted') {
    $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);

    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
    $stmt->execute();
    $stmt->get_result();

    // Update statement
    //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
    $stmt = $conn->prepare("UPDATE tbl_Users set password_hash = ? WHERE User_ID = ?");
    $stmt->bind_param("si", $password, $user_id);
    $stmt->execute();
    $stmt->get_result();

    // Remove safe update to protect the database from any manipulation.
    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
    $stmt->execute();

    if ($stmt) {
        // Success response
        echo ("password changed");
    } else {
        // Error response
        echo ("error");
    }
} else {
    echo "invalid input";
}

$conn->close();
