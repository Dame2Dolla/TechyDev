<?php

require_once __DIR__ . '/conn.php';

function postCleanForEmail($value)
{
    // Removes ASCI characters for escaping.
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    // Trim spaces
    $trimedValue = trim($value);
    // Filter trimedValue to sanitize for e-mail value.
    return filter_var($trimedValue, FILTER_SANITIZE_EMAIL);
}
//sanitization to avoid SQL injection and Cross site scripting - Security Consultant Clayton
function postCleanForText($value)
{
    // Removes ASCI characters for escaping.
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    // Removes spaces
    $trimedValue = trim($value);
    // Turns String to lower
    $trimedValueToLower = strtolower($trimedValue);
    // Using str_replace() function to replace the word
    $res = str_replace(array('\'', '"', ',', '; ', '<', '>'), ' ', $trimedValueToLower);
    // Remove numbers from text
    $res = preg_replace('/[0-9]+/', '', $res);
    // Turns first letter of the text to UpperCase.
    return filter_var(ucfirst($res), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

//sanitization to avoid SQL injection and Cross site scripting - Security Consultant Clayton
function postCleanForTextAndNumbers($value)
{
    // Removes ASCI characters for escaping.
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    // Removes spaces
    $trimedValue = trim($value);
    // Turns String to lower
    $trimedValueToLower = strtolower($trimedValue);
    // Using str_replace() function to replace the word
    $res = str_replace(array('\'', '"', ',', '; ', '<', '>', '&'), ' ', $trimedValueToLower);
    // Turns first letter of the text to UpperCase.
    return filter_var(ucfirst($res), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
//sanitization to avoid SQL injection and Cross site scripting - Security Consultant Clayton
function postCleanForPassword($value)
{
    // Removes ASCI characters for escaping.
    // This Mitigation is done to make it harder for bruteforce attack to succeed and for tampering mitigation. - Clayton Security consultant
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    $trimedValue = trim($value);
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $trimedValue);
    $lowercase = preg_match('@[a-z]@', $trimedValue);
    $number    = preg_match('@[0-9]@', $trimedValue);
    $specialChars = preg_match('@[^\w]@', $trimedValue);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($trimedValue) <= 15) {
        return 'Password not properly formatted';
    } else {
        return $trimedValue;
    }
}


// Get the data from the POST request

$firstName = postCleanForText(isset($_POST['firstName']) ? $_POST['firstName'] : "");
$lastName = postCleanForText(isset($_POST['lastName']) ? $_POST['lastName'] : "");
$address1 = postCleanForTextAndNumbers(isset($_POST['address1']) ? $_POST['address1'] : "");
$address2 = postCleanForTextAndNumbers(isset($_POST['address2']) ? $_POST['address2'] : "");
$postcode = postCleanForTextAndNumbers(isset($_POST['postCode']) ? $_POST['postCode'] : "");
$city = postCleanForText(isset($_POST['city']) ? $_POST['city'] : "");
$country = postCleanForText(isset($_POST['country']) ? $_POST['country'] : "");
$email = postCleanForEmail(isset($_POST['email']) ? $_POST['email'] : "");
$password = postCleanForPassword(isset($_POST['password']) ? $_POST['password'] : "");
$dob = isset($_POST['dob']) ? $_POST['dob'] : "";
$gender = postCleanForText(isset($_POST['gender']) ? $_POST['gender'] : "");

// Check if any variables are empty if yes throw an error message.
if (empty($firstName) || empty($lastName) || empty($address1) || empty($address2) || empty($postcode) || empty($city) || empty($country) || empty($email) || empty($password) || empty($dob) || empty($gender)) {
    echo "Try again";
} else {
    if ($password == 'Password not properly formatted') {
        echo "Password Incorrect";
    } else {
        // performing the password hashing in the signup form to insert into database - Security Consultant - Clayton Farrugia

        $password = password_hash($password, PASSWORD_DEFAULT);

        //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
        $stmts = $conn->prepare("SELECT * FROM Student WHERE email = ?");
        $stmts->bind_param("s", $email);
        $stmts->execute();
        $results = $stmts->get_result();

        if ($results->num_rows > 0) {
            echo "User Exist";
        } else {

            //prepared SQL statements.
            //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
            $sql = $conn->prepare("INSERT INTO Student (first_name, last_name, address1, address2, postcode, city, country, email, password, password_count, dob, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '3', ?, ?)");
            $sql->bind_param("sssssssssss", $firstName, $lastName, $address1, $address2, $postcode, $city, $country, $email, $password, $dob, $gender);
            $sql->execute();

            echo "User Created";
        }
    }
}
// Close the connection
$conn->close();
