<?php

    print_r($_SESSION['csrf_token']);
    // CSRF Token implementation 
    if($_POST['csrf_token'] !== $_SESSION['csrf_token']){
        http_response_code(403);
        exit('CSRF token mismatch');
    }
?>