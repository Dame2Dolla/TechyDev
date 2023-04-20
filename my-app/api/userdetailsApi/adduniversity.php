<?php
require "../session.php";
require "../conn.php";
require "../functionsForApi/functions.php";

//Get the data from the fetch request
$user_id = $_SESSION['id_user'];
$university = postCleanForText(isset($_POST['university']) ? $_POST['university'] : "");
$certificate = postCleanForText(isset($_POST['certificate']) ? $_POST['certificate'] : "");
$startdate = postCleanForTextAndNumbers(isset($_POST['startdate']) ? $_POST['startdate'] : "");
$enddate = postCleanForTextAndNumbers(isset($_POST['enddate']) ? $_POST['enddate'] : "");
$ongoing = filter_var($_POST["ongoing"], FILTER_VALIDATE_BOOLEAN);

if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
    echo "bad token";
    exit;
}

$_SESSION['date_expire'] = time();
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
$csrf_token = $_POST['token'];
if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {

    // Check if the university and degree exist
    $sql = "SELECT education_ID FROM tbl_Educations WHERE institutionName = ? AND courseTitle = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $university, $certificate);
    $stmt->execute();
    $result = $stmt->get_result();


    // if result of row come more than 1
    if ($result->num_rows > 0) {
        // The university and degree exist, prompt user
        echo "Already registered";
    } else {
        // The university and degree do not exist, create a new row in tbl_Educations
        $sql = "INSERT INTO tbl_Educations (institutionName, courseTitle) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $university, $certificate);
        $stmt->execute();
        $education_id = $conn->insert_id;
    }

    print_r($education_id);
    // Insert user-education mapping into tbl_Users_Educations
    $sql = "INSERT INTO tbl_Users_Educations (user_ID_pk_fk, education_ID_pk_fk, date_start, date_end, is_ongoing) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $user_id, $education_id, $startdate, $enddate, $ongoing);
    $stmt->execute();


    echo "Completed";

    $stmt->close();
} else {
    echo "bad token";
}
$conn->close();
