<?php
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
    // Using str_replace() function to replace the word -- Cross Side scripting
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

//Cleaning Number variables.
function postCleanForNumber($value)
{
    preg_replace("/[^0-9]/", "", $value);
    return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
}

// Trim the variables of any unneccasary spaces. 
function postCleanForPasswordLogin($value)
{
    // Removes ASCI characters for escaping.
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    $trimedValue = trim($value);
    return $trimedValue;
}

?>