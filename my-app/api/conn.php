<?php
    //Error reporting function that disabled error messages.
    error_reporting(0);
    session_start();
    //Details of the Database.
    $servername = "localhost";
    $username = "u704680868_admin";
    $password = "n!W!6Gqe?W8";
    $dbname = "u704680868_studentmind_db";

    // Create a new connection and assign to $conn variable
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection exists, if not then terminate it and show an error message.
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>