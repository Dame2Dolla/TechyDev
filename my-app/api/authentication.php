<?php

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

// Trim the variables of any unneccasary spaces. 
function postCleanForPassword($value)
{
    // Removes ASCI characters for escaping.
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    $trimedValue = trim($value);
    return $trimedValue;
}

//Sanitize, filtering & ESCAPE
// Get email and password from POST request and store each of them in a variable.
$email = postCleanForEmail($_POST['email']);
$passworddb = postCleanForPassword($_POST['password']);

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
    $row = $result->fetch_assoc();

    // This will check if the password_count column has the row with 0 as value, if no it will got to the else statement and 
    // starts checking for the email credentials if valid or not.  Security Consultant-Clayton
    if ($row['password_count'] <= 0) {
        echo "Locked account";
    } else {
        //To prevent SQL injections we used something called prepared statements which uses bound parameters. - Security Consultant - Clayton
        $stmtr = $conn->prepare("SELECT * FROM Student WHERE email = ?");
        $stmtr-> bind_param("s",$email);
        $stmtr->execute();
        $resultz = $stmtr->get_result();
        $rowz = $resultz->fetch_assoc();


        // If the query returns at least one row, and the password is the same as the hashed value the user exists. Security Consultant-Clayton
  
        if ($resultz->num_rows > 0 && password_verify($passworddb, $rowz['password'])) {
            
            $_SESSION['id_user'] = $rowz['ID'];
            $_SESSION['first_name'] = $rowz['first_name'];
            $_SESSION['last_name'] = $rowz['last_name'];
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
            $stmt = $conn->prepare("UPDATE Student set password_count = password_count -1 WHERE email = ?");
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
    echo "Invalid";
}

$conn->close();
?>
