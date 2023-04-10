<?php
require_once __DIR__ . '/conn.php';

$user_id = $_SESSION['id_user'];

// remove Safe update from MySQL to implement an update sql statement.

$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
$stmt->execute();
$stmt->get_result();

//To be reviewed...
$stmts = $conn->prepare("DELETE FROM Student WHERE ID = ?");
$stmts->bind_param("i", $student_id);
$stmts->execute();
$results = $stmts->get_result();

// Remove safe update to protect the database from any manipulation.
$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
$stmt->execute();
$stmt->get_result();

session_destroy();
header('Location: index.php');
exit;
