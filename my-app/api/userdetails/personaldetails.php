<?php
require __DIR__ . "/../conn.php";



// Fetch a user about section
$user_id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM tbl_Users urs, tbl_Address ads WHERE urs.address_ID_fk = ads.address_ID AND user_ID = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Output the quote
if ($result->num_rows > 0) {
    $gender = $row["gender"];
    $pronouns = $gender == "Male" ? 'male (he/him)' : ($gender == "Female" ? 'female (she/her)' : $gender);

    echo '<div>';
    echo '<div class=" user-details-flex pt-2">';
    echo '<p class="user-details user-details-text-left">' . $row["email"] . '</p>';
    echo '<p class="user-details user-details-text-right">' . $pronouns . '</p>';
    echo '</div>';
    echo '</div>';
    echo '<div>';
    echo '<div class="user-details-flex">';
    echo '<p class="user-details user-details-text-left">' . $row["city_town"] . ', ' . $row["country"] . '</p>';
    echo '</div>';
    echo '</div>';
    echo '<div class="user-details-flex">';
    echo '<p class="user-details user-details-text-left">&#43; ' . $row["mob_num"] . '</p>';
    echo '<p class="user-details user-details-text-right">' . $row["dob"] . '</p>';
    echo '</div>';
} else {
    echo '<h1 class="text-name">Database error, please contact customer service.</h1>';
}
