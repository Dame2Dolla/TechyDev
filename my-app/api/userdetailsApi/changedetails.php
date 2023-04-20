<?php
require __DIR__ . "/../session.php";
require __DIR__ . "/../conn.php";
require "../functionsForApi/functions.php";

$detailUser = postCleanForNumber($_POST['detailUser']);
$firstName = postCleanForText(isset($_POST['firstName']) ? $_POST['firstName'] : "");
$middleName = postCleanForText(isset($_POST['middleName']) ? $_POST['middleName'] : "");
$lastName = postCleanForText(isset($_POST['familyName']) ? $_POST['familyName'] : "");
$mobileNumber = postCleanForNumber(isset($_POST['contactNumber']) ? $_POST['contactNumber'] : "");
$address1 = postCleanForTextAndNumbers(isset($_POST['lineOne']) ? $_POST['lineOne'] : "");
$address2 = postCleanForTextAndNumbers(isset($_POST['lineTwo']) ? $_POST['lineTwo'] : "");
$postcode = postCleanForTextAndNumbers(isset($_POST['postCode']) ? $_POST['postCode'] : "");
$city = postCleanForText(isset($_POST['cityTown']) ? $_POST['cityTown'] : "");
$country = postCleanForText(isset($_POST['country']) ? $_POST['country'] : "");
$gender = postCleanForText(isset($_POST['gender']) ? $_POST['gender'] : "");

if (!isset($_POST['token']) || !isset($_SESSION['token'])) {
    echo "bad token";
    exit;
}

$_SESSION['date_expire'] = time();
$sixtyMinutes = $_SESSION['date_expire'] + (60 * 60);
$csrf_token = $_POST['token'];

$stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 0");
$stmt->execute();
$stmt->get_result();
if (hash_equals($_SESSION['token'], $csrf_token) && $_SESSION['token-expire'] <= $sixtyMinutes) {

    $stmt = $conn->prepare("UPDATE tbl_Users SET givenName = ?, middleName = ?, familyName = ?, gender = ?, mob_num = ? WHERE user_ID = ?");
    $stmt->bind_param("ssssii", $firstName, $middleName, $lastName, $gender, $mobileNumber, $detailUser);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM tbl_Users usr, tbl_Address addr WHERE usr.address_ID_fk = addr.address_ID AND user_ID = ?");
    $stmt->bind_param('i', $detailUser);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $addressID = $row["address_ID"];

    $stmt = $conn->prepare("UPDATE tbl_Address SET line1 = ?, line2 = ?, post_code = ?, city_town = ?, country = ? WHERE address_ID = ?");
    $stmt->bind_param("sssssi", $address1, $address2, $postcode, $city, $country, $addressID);
    $stmt->execute();

    $stmt = $conn->prepare("SET SQL_SAFE_UPDATES = 1");
    $stmt->execute();
    $stmt->get_result();

    echo "Complete";

    $stmt->close();
} else {
    echo "bad token";
}
$conn->close();
