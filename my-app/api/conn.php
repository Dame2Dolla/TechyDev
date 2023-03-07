<?php
    //Error reporting function that disabled error messages.
    //error_reporting(0);
    session_start();
    //Details of the Database.
    $servername = "localhost";
    $username = "id20324296_admin_techy";
    $password = "\zEkViUe^wvmj@6[";
    $dbname = "id20324296_dbstudentmind";

    // Create a new connection and assign to $conn variable
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection exists, if not then terminate it and show an error message.
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>