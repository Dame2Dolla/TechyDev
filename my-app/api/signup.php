<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/conn.php';

require "./functionsForApi/functions.php";

//Remove Do not allow on final version
//Add this at the beginning of your authentication.php file
header("Access-Control-Allow-Origin: *");
// If you need to allow specific methods, like POST, you can add the following line
header("Access-Control-Allow-Methods: POST");
// You may also need to allow specific headers, like Content-Type
header("Access-Control-Allow-Headers: Content-Type");

// Get the data from the POST request

$firstName = postCleanForText(isset($_POST['firstName']) ? $_POST['firstName'] : "");
$middleName = postCleanForText(isset($_POST['middleName']) ? $_POST['middleName'] : "");
$lastName = postCleanForText(isset($_POST['lastName']) ? $_POST['lastName'] : "");
$mobileNumber = postCleanForNumber(isset($_POST['mobile']) ? $_POST['mobile'] : "");
$address1 = postCleanForTextAndNumbers(isset($_POST['address1']) ? $_POST['address1'] : "");
$address2 = postCleanForTextAndNumbers(isset($_POST['address2']) ? $_POST['address2'] : "");
$postcode = postCleanForTextAndNumbers(isset($_POST['postCode']) ? $_POST['postCode'] : "");
$city = postCleanForText(isset($_POST['city']) ? $_POST['city'] : "");
$country = postCleanForText(isset($_POST['country']) ? $_POST['country'] : "");
$email = postCleanForEmail(isset($_POST['email']) ? $_POST['email'] : "");
$password = postCleanForPassword(isset($_POST['password']) ? $_POST['password'] : "");
$dob = isset($_POST['dob']) ? $_POST['dob'] : "";
$gender = postCleanForText(isset($_POST['gender']) ? $_POST['gender'] : "");
$bioDesc = "Emptiness...";

if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
    echo "bad token";
    exit;
}


// create session for the current time
$_SESSION['date_expire'] = time();
// aquire session date_expire and add 60 minutes
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
$csrf_token = $_POST['token'];

// Check if any variables are empty if yes throw an error message.
if (empty($firstName) || empty($lastName) || empty($address1) || empty($address2) || empty($postcode) || empty($city) || empty($country) || empty($email) || empty($password) || empty($dob) || empty($gender) || empty($mobileNumber)) {
    echo "Try again";
} else {
    if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {
        if ($password == 'Password not properly formatted') {
            echo "Password Incorrect";
        } else {
            // performing the password hashing in the signup form to insert into database - Security Consultant - Clayton Farrugia
            $password = password_hash($password, PASSWORD_DEFAULT);

            //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
            $stmts = $conn->prepare("SELECT * FROM tbl_Users WHERE email = ?");
            $stmts->bind_param("s", $email);
            $stmts->execute();
            $results = $stmts->get_result();

            if ($results->num_rows > 0) {
                echo "User Exist";
            } else {

                //prepared SQL statements.
                //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
                $sql = $conn->prepare("INSERT INTO tbl_Address (line1, line2, post_code, city_town, country) VALUES (?, ?, ?, ?,?)");
                $sql->bind_param("sssss", $address1, $address2, $postcode, $city, $country);
                $sql->execute();

                //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
                $stmts = $conn->prepare("SELECT address_ID FROM tbl_Address WHERE line1 = ?");
                $stmts->bind_param("s", $address1);
                $stmts->execute();
                $result = $stmts->get_result();
                $row = $result->fetch_assoc();

                $tmp_storage = $row['address_ID'];

                //prepared SQL statements.
                //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
                $sql = $conn->prepare("INSERT INTO tbl_Users (givenName, middleName, familyName, gender, dob, email, mob_num,bio_desc,password_hash,password_count,address_ID_fk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '3', ?)");
                $sql->bind_param("ssssssssss", $firstName, $middleName, $lastName, $gender, $dob, $email, $mobileNumber, $bioDesc, $password, $tmp_storage);
                $sql->execute();

                echo "User Created";
            }
        }
    } else {
        echo "bad token";
    }
}
// Close the connection
$conn->close();
