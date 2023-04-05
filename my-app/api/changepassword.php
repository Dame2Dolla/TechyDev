<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/conn.php';
require_once __DIR__ . '/functionsForApi/functions.php';

$email = postCleanForEmail($_POST['email']);
$password = postCleanForPasswordLogin($_POST['password']);

$password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
$stmt->execute();
$stmt->get_result();

// Update statement
//To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
$stmt = $conn->prepare("UPDATE tbl_Users set password_hash = ?  WHERE email = ?");
$stmt->bind_param("ss", $password, $email);
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

$conn->close();
