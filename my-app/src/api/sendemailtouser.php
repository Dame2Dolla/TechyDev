<?php

// Get the email address from the POST request
$email = $_POST['email'];


// Create the email message with a link to reset the password
$subject = "Password reset instructions for your account";
$message = "Dear user,\n\n";
$message .= "Please click the following link to reset your password:\n\n";
$message .= "<This is a link>\n";
$message .= "If you did not request a password reset, please ignore this message.\n\n";
$message .= "Best regards,\nThe StudentMind team";

// Send the email using PHP's built-in mail() function
// You may need to configure your server to enable mail sending
$headers = "From: techy_2023@outlook.com\r\n";
$headers .= "Reply-To: techy_2023@outlook.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

if (mail($email, $subject, $message, $headers)) {
    echo "Password reset instructions have been sent to your email address.";
} else {
    echo "Failed to send password reset instructions.";
}
?>