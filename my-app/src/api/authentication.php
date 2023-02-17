<?php

    //Need to know the database details 
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create a new connection and assign to $conn variable
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection exists, if not then terminate it and show an error message.
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get email and password from POST request and store each of them in a variable.
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check if the user exists and store it to the variable $sql.
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // If the query returns at least one row, the user exists. Else user does not exist.
    if ($result->num_rows > 0) {
        echo "User exists";
    } else {
        echo "User does not exist";
    }

    $conn->close();
?>