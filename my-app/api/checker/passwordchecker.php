<?php
require __DIR__ . "/../session.php";
require __DIR__ . "/../conn.php";

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

    if (!$uppercase || !$lowercase || !$number || !$specialChars) {
        return 'Password not properly formatted';
    } else {
        return $trimedValue;
    }
}

// Get email and password from POST request and store each of them in a variable.
$oldpassword = postCleanForPassword($_POST['oldpassword']);

// Fetch a user data section
$user_id = $_SESSION['id_user'];
if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
    echo "bad token";
    exit;
}

$_SESSION['date_expire'] = time();
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
$csrf_token = $_POST['token'];
if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {

    $stmt = $conn->prepare("SELECT * FROM tbl_Users WHERE user_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (password_verify($oldpassword, $row['password_hash'])) {
        echo 'Correct';
    } else {
        echo 'Not Matched';
    }
} else {
    echo "bad token";
}

$conn->close();
