<?php
require_once __DIR__ . '/conn.php';

$user_id = $_SESSION['id_user'];

// remove Safe update from MySQL to implement an update sql statement.

$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
$stmt->execute();
$stmt->get_result();

//To be reviewed...
$stmts = $conn->prepare("DELETE tbl_Users, tbl_Users_Educations, tbl_Users_Projects, tbl_Address FROM tbl_Users LEFT JOIN tbl_Users_Educations ON tbl_Users.user_ID = tbl_Users_Educations.user_ID_pk_fk LEFT JOIN tbl_Users_Projects ON tbl_Users.user_ID = tbl_Users_Projects.user_ID_pk_fk LEFT JOIN tbl_Address ON tbl_Users.address_ID_fk = tbl_Address.address_ID WHERE tbl_Users.user_ID = ?;");
$stmt->bind_param("i", $user_id);
$stmts->execute();
$results = $stmts->get_result();

// Remove safe update to protect the database from any manipulation.
$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
$stmt->execute();
$stmt->get_result();

session_destroy();
echo ("Complete");
