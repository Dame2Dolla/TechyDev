<?php
//Error reporting function that disabled error messages.
error_reporting(0);
// Start the session.
session_start();
session_destroy();
header('Location: index.php');
exit;
?>
