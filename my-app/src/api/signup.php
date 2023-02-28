<?php

//Details of the Database.
$servername = "localhost";
$username = "id20324296_tester";
$password = "0123456789abc-A";
$dbname = "id20324296_test";

// Create a new connection and assign to $conn variable
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection exists, if not then terminate it and show an error message.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function postCleanForEmail($value)
{
    // Trim spaces
    $trimedValue = trim($value);
    // Filter trimedValue to sanitize for e-mail value.
    return filter_var($trimedValue, FILTER_SANITIZE_EMAIL);
}

function postCleanForText($value)
{
    $trimedValue = trim($value);
    // Turns String to lower
    $trimedValueToLower = strtolower($trimedValue);
    // Using str_replace() function to replace the word
    $res = str_replace(array('\'', '"', ',', '; ','<', '>'), ' ', $trimedValueToLower);
    // Remove numbers from text
    $res = preg_replace('/[0-9]+/', '', $res);
    // Turns first letter of the text to UpperCase.
    return filter_var(ucfirst($res), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function postCleanForPassword($value)
{
    $trimedValue = trim($value);
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $trimedValue);
    $lowercase = preg_match('@[a-z]@', $trimedValue);
    $number    = preg_match('@[0-9]@', $trimedValue);
    $specialChars = preg_match('@[^\w]@', $trimedValue);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($trimedValue) < 8) {
        return 'Password not properly formatted';
    } else {
        return $trimedValue;
    } 
}

// Get the data from the POST request

$firstName = postCleanForText(isset($_POST['firstName']) ? $_POST['firstName'] : "");
$lastName = postCleanForText(isset($_POST['lastName']) ? $_POST['lastName'] : "");
$email = postCleanForEmail(isset($_POST['email']) ? $_POST['email'] : "");
$password_checker = postCleanForPassword(isset($_POST['password']) ? $_POST['password'] : "");
$dob = isset($_POST['dob']) ? $_POST['dob'] : "";
$gender = postCleanForText(isset($_POST['gender']) ? $_POST['gender'] : "");

if ($password_checker == 'Password not properly formatted') {
    echo "Password Incorrect";
} else {

    $password_checker = password_hash($password_checker, PASSWORD_DEFAULT);
    $stmts = $conn->prepare("SELECT * FROM Student WHERE email = ?");
    $stmts->bind_param("s", $email);
    $stmts->execute();
    $results = $stmts->get_result();

    if ($results->num_rows > 0) {
        echo "User Exist";
    } else {
        //prepared SQL statements.
        $sql = $conn->prepare("INSERT INTO Student (first_name, last_name, email, password, password_count, dob, gender) VALUES (?, ?, ?, ?,'3', ?, ?)");
        $sql->bind_param("ssssss", $firstName, $lastName, $email, $password_checker, $dob, $gender);
        $sql->execute();
        echo "User Created";
    }
}


// Close the connection
$conn->close();
?>