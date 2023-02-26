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

    $stmt = $conn->prepare("SELECT password_count FROM Student");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->fetch_assoc() >= 0) {
        echo "Locked account";
    } else {
        //Checks if the user and password match
        $stmt = $conn->prepare("SELECT * FROM Student WHERE email = ? password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        // If the query returns at least one row, the user exists.
        if ($result->num_rows > 0) {
            echo "User exists";
        } else {
            //Decrement the user password count -1;
            $stmt = $conn->prepare("SELECT * FROM Student WHERE password = ?");
            $stmt->bind_param("s", $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Return alert to user that email/password is invalid
            echo "Invalid Password";
            //----------------------------------------------------Update password count -1 --------------------------------------------
            // remove Safe update from MySQL to implement an update sql statement.
            $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
            $stmt->execute();
            $stmt->get_result();

            // Update statement
            $stmt = $conn->prepare("UPDATE Student set password_count=password_count-1");
            $stmt->execute();
            $stmt->get_result();
            // Remove safe update to protect the database from any manipulation.
            $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
            $stmt->execute();
            $stmt->get_result();
        }
    }
}

$conn->close();
