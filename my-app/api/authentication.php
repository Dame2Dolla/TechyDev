<?php

require_once __DIR__ . '/conn.php';

require "./functionsForApi/functions.php";


//Sanitize, filtering & ESCAPE
// Get email and password from POST request and store each of them in a variable.
$email = postCleanForEmail($_POST['email']);
$passworddb = postCleanForPasswordLogin($_POST['password']);
$csrf_token = $_POST['token'];

// Query the database to check if the user exists and store it to the variable $sql.
// Implementation of the prepare SQL statements for prevention of SQL Injection.
// Replacing our variables with "?".

$stmt = $conn->prepare("SELECT * FROM tbl_Users WHERE email = ?");

// Using blind_param to associate the variable with the "s" for String. 
// Then the variables are bound to the SQL ? in chronological order.
$stmt->bind_param("s", $email);

// Finally the SQL is executed
$stmt->execute();
// get_result() is used to fetch the result.
$result = $stmt->get_result();


// for the logging form to work it has to pass 2 conditions. 
// 1. Token received via html needs to be the same as token of the session. 
// This is compared to the hash_equals function.
// 2. Context: in the securitycsrf.php creates a new session with the current time(). 
// 2.1 Then we create a newer session and input the current time() of the server.
// 2.2 We increase that time by 60 seconds * 60 minutes.
// 2.3 We then check if the token_expire that was created in the securitycsrf on load of webpage is
// Smaller than the newer session that was created in this php file.   
// Create session for the current time
$_SESSION['date_expire'] = time();
// Aquire session date_expire and add 60 minutes

$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);

if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {

    if ($result->num_rows > 0) {

        $stmtx = $conn->prepare("SELECT is_minor FROM tbl_Users WHERE email = ?");
        $stmtx->bind_param("s", $email);
        $stmtx->execute();
        $resultx = $stmt->get_result();
        $rowx = $result->fetch_assoc();

        if ($rowx['is_minor'] == 0) {


            $stmt = $conn->prepare("SELECT password_count FROM tbl_Users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // This will check if the password_count column has the row with 0 as value, if no it will got to the else statement and 
            // starts checking for the email credentials if valid or not.  Security Consultant-Clayton
            if ($row['password_count'] <= 0) {
                echo "Locked account";
            } else {
                //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
                $stmtr = $conn->prepare("SELECT * FROM tbl_Users WHERE email = ?");
                $stmtr->bind_param("s", $email);
                $stmtr->execute();
                $resultz = $stmtr->get_result();
                $rowz = $resultz->fetch_assoc();


                // If the query returns at least one row, and the password is the same as the hashed value the user exists. Security Consultant-Clayton

                if ($resultz->num_rows > 0 && password_verify($passworddb, $rowz['password_hash'])) {

                    $_SESSION['id_user'] = $rowz['user_ID'];
                    $_SESSION['first_name'] = $rowz['givenName'];
                    $_SESSION['last_name'] = $rowz['familyName'];
                    echo "Successful";

                    // if the password does'nt match it will go to the else statement and starts the process for updating password_count column - 
                    // Security Consultant-Clayton
                } else {

                    //----------------------------------------------------Update password count -1 --------------------------------------------
                    // remove Safe update from MySQL to implement an update sql statement.
                    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
                    $stmt->execute();
                    $stmt->get_result();

                    // Update statement
                    //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
                    $stmt = $conn->prepare("UPDATE tbl_Users set password_count = password_count -1 WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->get_result();

                    // Remove safe update to protect the database from any manipulation.
                    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
                    $stmt->execute();
                    $stmt->get_result();

                    // Return alert to user that email/password is invalid
                    echo "Invalid Password";
                }
            }
        } else {
            echo "under age";
        }
    } else {
        echo "not found";
    }
} else {
    echo "bad token";
}

$conn->close();
