<?php
//creating the session with 32 random characters and creating a session for token expiry time - IT consultant Clayton
//Session token is set with a 32 random characters.
$_SESSION['token'] = bin2hex(random_bytes(32));
// Session token expires in 1 hour.
// Time() saves the data in an Unix timestamp.
$_SESSION['token-expire'] = time();
?>