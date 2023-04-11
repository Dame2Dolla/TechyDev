<?php
session_start();
require_once __DIR__ . '/conn.php';

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

//Sanitize, filtering & ESCAPE

// Get email and password from POST request and store each of them in a variable.
$email = postCleanForEmail($_POST['email']);

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
    echo "User exists";
} else {
    echo "User does not exist";
}

$conn->close();
