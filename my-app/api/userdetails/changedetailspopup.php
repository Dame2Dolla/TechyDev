<?php
require_once __DIR__ . '/conn.php';

// Fetch a user about section
$user_id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM tbl_Users usr, tbl_Address addr WHERE usr.address_ID_fk = addr.address_ID AND user_ID = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

//Checks if Gender is Male, Female or custom. If custom than show value in the textbox:
$gender = $row["gender"];
$maleSelected = $gender === 'Male' ? 'selected' : '';
$femaleSelected = $gender === 'Female' ? 'selected' : '';
$customSelected = ($gender !== 'Male' && $gender !== 'Female') ? 'selected' : '';
$customGenderValue = ($gender !== 'Male' && $gender !== 'Female') ? $gender : '';

// Read the contents of country.php and stored in $countryOptions
$countryOptions = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php_require/country.php');

// Output the quote
echo '<div class="popup-personal-details-display">';
echo    '<div class="popup-details-display">';
echo '      <label class="popup-personal-text">Given name</label>';
echo '<input type="text" id="firstName" placeholder="First Name" class="popup-personal-text-boxes pl-3" value="' . $row["givenName"] . '" />';
echo '</div>';
echo '<div class="popup-details-display">';
echo '<label class="popup-personal-text">Middle name</label>';
echo '<input type="text" id="middleName" placeholder="Middle Name" class="popup-personal-text-boxes pl-3" value="' . $row["middleName"] . '"/>';
echo '</div>';
echo '<div class="popup-details-display">';
echo '<label class="popup-personal-text">Last name</label>';
echo '<input type="text" id="familyName" placeholder="Last Name" class="popup-personal-text-boxes pl-3" value="' . $row["familyName"] . '"/>';
echo '</div>';
echo '</div>';
echo '<div class="popup-personal-details-display">';
echo    '<div class="popup-details-display">';
echo  '<label class="popup-personal-text">Mobile number</label>';
echo '<input type="text" pattern="[0-9 ]+" id="contactNumber" placeholder="+00 0000 0000" class="popup-personal-text-boxes pl-3" value="' . $row["mob_num"] . '" />';
echo '</div>';
echo '<div>';
echo  '<label class="popup-personal-text">Gender</label>';
echo '<div>';
echo '<select id="gender" name="gender" class="popup-personal-text-boxes pl-3">';
echo   "<option value=\"male\" {$maleSelected}>Male</option>";
echo   "<option value=\"female\" {$femaleSelected}>Female</option>";
echo   "<option value=\"custom\" {$customSelected}>Custom</option>";
echo '</select>';
echo "<input type=\"text\" id=\"customGender\" placeholder=\"Custom gender\" class=\"popup-personal-text-boxes pl-3\" value=\"{$customGenderValue}\" />";
echo '</div>';
echo '</div>';
echo '</div>';
echo '<label class="popup-personal-text">Address</label>';
echo '<div class="popup-details-display">';
echo '<div class="popup-personal-details-display">';
echo '<input type="text" id="lineOne" placeholder="Line 1" class="popup-personal-text-boxes pl-3"  value="' . $row["line1"] . '"/>';
echo '<input type="text" id="lineTwo" placeholder="Line 2" class="popup-personal-text-boxes pl-3" value="' . $row["line2"] . '"/>';
echo '<input type="text" id="city_town" placeholder="City" class="popup-personal-text-boxes pl-3" value="' . $row["city_town"] . '"/>';
echo '</div>';
echo '<div class="popup-country">';
echo '<input type="text" id="postCode" placeholder="PostCode" class="popup-personal-text-boxes pl-3" value="' . $row["post_code"] . '" />';
echo '<select id="country" name="country" class="popup-personal-text-boxes pl-3" >';
echo '<option value="' . $row["country"] . '" disabled selected>' . $row["country"] . '</option>';
echo $countryOptions;
echo '</select>';
echo '</div>';
echo '</div>';
echo '<div class="button-sorting">';
echo '<button type="button" class="change-email-button" onclick="openEmailPopup()">Change email</button>';
