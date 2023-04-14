<?php
require "../session.php";
require "../conn.php";
require "../functionsForApi/functions.php";


$user_id = $_SESSION['id_user'];
$projectName = postCleanForText(isset($_POST['projectName']) ? $_POST['projectName'] : "");
$projectDesc = postCleanForText(isset($_POST['projectDesc']) ? $_POST['projectDesc'] : "");
$ongoing = filter_var($_POST["ongoing"], FILTER_VALIDATE_BOOLEAN);


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
$conn->close();
