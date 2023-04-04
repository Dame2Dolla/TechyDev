<?php
//Error reporting function that disabled error messages.
error_reporting(0);
// Start the session.
require_once __DIR__ . '/session.php';
session_destroy();
header('Location: index.php');
exit;
