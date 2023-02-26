<?php

//Details of the Database.
$servername = "localhost";
$username = "id20324296_teser";
$password = "0123456789abc-A";
$dbname = "id20324296_test";

// Create a new connection and assign to $conn variable
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection exists, if not then terminate it and show an error message.
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

// Trim the variables of any unneccasary spaces. 
function postCleanForPassword($value)
{
    $trimedValue = trim($value);
    return $trimedValue;
}

//Sanitize, filtering & ESCAPE

// Get email and password from POST request and store each of them in a variable.
$email = postCleanForEmail($_POST['email']);
$password = postCleanForPassword($_POST['password']);

// Query the database to check if the user exists and store it to the variable $sql.
// Implementation of the prepare SQL statements for prevention of SQL Injection.
// Replacing our variables with "?".

$stmt = $conn->prepare("SELECT * FROM Student WHERE email = ?");

// Using blind_param to associate the variable with the "s" for String. 
// Then the variables are bound to the SQL ? in chronological order.
$stmt->bind_param("s", $email);

// Finally the SQL is executed
$stmt->execute();
// get_result() is used to fetch the result.
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $stmt = $conn->prepare("SELECT * FROM Student WHERE password = ?");
    $stmt->bind_param("s", $password);
    $stmt->execute();
    $result = $stmt->get_result();
    // If the query returns at least one row, the user exists. Else user does not exist.
    if ($result->num_rows > 0) {
        echo "User exists";
    } else {
        $stmt = $conn->prepare("SELECT * FROM Student WHERE password = ?");
        $stmt->bind_param("s", $password);
        $stmt->execute();
        $result = $stmt->get_result();


        echo "Invalid Password";
    }
}else {
    echo "Invalid Email";
}






$conn->close();
?>