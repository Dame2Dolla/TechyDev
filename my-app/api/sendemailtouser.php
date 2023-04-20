<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/conn.php';

function postCleanForEmail($value)
{
    $trimedValue = trim($value);
    return filter_var($trimedValue, FILTER_SANITIZE_EMAIL);
}

//Obtain the json file from javascript.
$input = json_decode(file_get_contents('php://input'), true);
// Get the email address from the POST request
$email = postCleanForEmail($input['email']);


// Create the email message with a link to reset the password
$subject = "Password reset instructions for your account";
$message = "Dear user,\n\n";
$message .= "Please click the following link to reset your password:\n\n";
$message .= "<This is a link>\n";
$message .= "If you did not request a password reset, please ignore this message.\n\n";
$message .= "Best regards,\nThe StudentMind team";

// Send the email using PHP's built-in mail() function
// You may need to configure your server to enable mail sending
// Reference for this code: https://www.socketlabs.com/blog/email-api-php/
$headers = "From: techy_2023@outlook.com\r\n";
$headers .= "Reply-To: techy_2023@outlook.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

if (mail($email, $subject, $message, $headers)) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'Email sent']);
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'Failed']);
}
