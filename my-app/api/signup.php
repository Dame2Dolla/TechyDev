<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/conn.php';

require "./functionsForApi/functions.php";

//Obtain the json file from javascript.
$input = json_decode(file_get_contents('php://input'), true);

// Get the data from the POST request payload sent from the Javascript submitform.js
$firstName = postCleanForText(isset($input['firstName']) ? $input['firstName'] : "");
$middleName = postCleanForText(isset($input['middleName']) ? $input['middleName'] : "");
$lastName = postCleanForText(isset($input['lastName']) ? $input['lastName'] : "");
$mobileNumber = postCleanForNumber(isset($input['mobile']) ? $input['mobile'] : "");
$address1 = postCleanForTextAndNumbers(isset($input['address1']) ? $input['address1'] : "");
$address2 = postCleanForTextAndNumbers(isset($input['address2']) ? $input['address2'] : "");
$postcode = postCleanForTextAndNumbers(isset($input['postCode']) ? $input['postCode'] : "");
$city = postCleanForText(isset($input['city']) ? $input['city'] : "");
$country = postCleanForText(isset($input['country']) ? $input['country'] : "");
$email = postCleanForEmail(isset($input['email']) ? $input['email'] : "");
$password = postCleanForPassword(isset($input['password']) ? $input['password'] : "");
$dob = isset($input['dob']) ? $input['dob'] : "";
$gender = postCleanForText(isset($input['gender']) ? $input['gender'] : "");
$bioDesc = "Emptiness...";

// Check if value of both $csrftoken and $_SESSION['token'] is empty. - Security Consultant - Clayton Farrugia
// If yes than send "Bad token" and end the API.
if (!isset($input['token']) || !isset($_SESSION['token'])) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'bad token']);
    exit;
}

//If token is not empty, store value into $csrf_token
$csrf_token = $input['token'];

// create session for the current time
$_SESSION['date_expire'] = time();
// aquire session date_expire and add 60 minutes
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);

// Check if any variables are empty if yes throw an error message.
if (empty($firstName) || empty($lastName) || empty($address1) || empty($address2) || empty($postcode) || empty($city) || empty($country) || empty($email) || empty($password) || empty($dob) || empty($gender) || empty($mobileNumber)) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'Try again']);
} else {
    //Compare the 2 values together to check if they match. - Security Consultant - Clayton Farrugia
    //and check if the session has passed the 1 hour rule.   
    if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {
        if ($password == 'Password not properly formatted') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'Password Incorrect']);
        } else {
            // performing the password hashing in the signup form to insert into database - Security Consultant - Clayton Farrugia
            // Increased cost of default value from 10 to 15. To increase the complexity of the password salt.
            $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);

            //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
            $stmts = $conn->prepare("SELECT * FROM tbl_Users WHERE email = ?");
            $stmts->bind_param("s", $email);
            $stmts->execute();
            $results = $stmts->get_result();

            if ($results->num_rows > 0) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'User Exist']);
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

                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'User Created'
                ]);
            }
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'bad token']);
    }
}
// Close the connection
$conn->close();
