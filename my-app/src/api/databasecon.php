<?
//Details of the Database.
$servername = "localhost";
$username = "id20324296_teser";
$password = "0123456789abc-A";
$dbname = "id20324296_tet";

// Create a new connection and assign to $conn variable
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection exists, if not then terminate it and show an error message.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>