<?php

require "../conn.php";
require "../functionsForApi/functions.php";
require "../session.php";

//Sanitize, filtering & ESCAPE

$password = postCleanForTextAndNumbers($_POST['password']);
$user_id = $_SESSION['id_user'];

$password = password_hash($password, PASSWORD_DEFAULT);

//----------------------------------------------------Update password count -1 --------------------------------------------
// remove Safe update from MySQL to implement an update sql statement.
$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
$stmt->execute();
$stmt->get_result();

// Update statement
// To prevent SQL injections, we use prepared statements with bound parameters.
$stmt = $conn->prepare("UPDATE tbl_Users SET password_hash = ? WHERE user_ID = ?");
$stmt->bind_param("si", $password, $user_id);
$stmt->execute();

// Remove safe update to protect the database from any manipulation.
$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
$stmt->execute();
$stmt->get_result();

echo "Complete";

$stmt->close();
$conn->close();
?>