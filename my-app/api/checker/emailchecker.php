<?php
require __DIR__ . "/../session.php";
require __DIR__ . "/../conn.php";

// Trim the variables of any unneccasary spaces. 
function postCleanForEmail($value)
{
    // Removes ASCI characters for escaping.
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    // Trim spaces
    $trimedValue = trim($value);
    // Filter trimedValue to sanitize for e-mail value.
    return filter_var($trimedValue, FILTER_SANITIZE_EMAIL);
}
//Obtain the json file from javascript.
$input = json_decode(file_get_contents('php://input'), true);

//Sanitize, filtering & ESCAPE
// Get email and password from POST request and store each of them in a variable.
$email = postCleanForEmail($input['email']);

if (!isset($input['token']) || !isset($_SESSION['token'])) {
    echo "bad token";
    exit;
}

$_SESSION['date_expire'] = time();
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
$csrf_token = $input['token'];

if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {

    $stmt = $conn->prepare("SELECT * FROM tbl_Users WHERE email = ?");

    // Using blind_param to associate the a variables with the "s" for String. 
    // Then the variables are bound to the SQL ?.
    $stmt->bind_param("s", $email);
    // Finally the SQL is executed
    $stmt->execute();
    // get_result() is used to fetch the result.
    $result = $stmt->get_result();


    // Return response
    if (mysqli_num_rows($result) > 0) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'User exists']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'User does not exist']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'bad token']);
}

$conn->close();
