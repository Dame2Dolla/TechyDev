<?php
$servername = "localhost";
$username = "id20324296_tester";
$password = "0123456789abc-A";
$dbname = "id20324296_test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Trim the variables of any unneccasary spaces. 
function postCleanForEmail($value)
{
    // Trim spaces
    $trimedValue = trim($value);
    // Filter trimedValue to sanitize for e-mail value.
    return filter_var($trimedValue, FILTER_SANITIZE_EMAIL);
}

//Sanitize, filtering & ESCAPE

// Get email and password from POST request and store each of them in a variable.
$email = postCleanForEmail($_POST['email']);

$stmt = $conn->prepare("SELECT * FROM Student WHERE email = ?");

// Using blind_param to associate the a variables with the "s" for String. 
// Then the variables are bound to the SQL ?.
$stmt->bind_param("s", $email);
// Finally the SQL is executed
$stmt -> execute();
// get_result() is used to fetch the result.
$result = $stmt -> get_result();


// Return response
if (mysqli_num_rows($result) > 0) {
    echo "User exists";
} else {
    echo "User does not exist";
}

$conn->close();
?>