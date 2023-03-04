<?php require "./php_require/htmlheader.php" ?>
<title>Profile</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <img src="./images/icon.png" width="60px" height="60px" alt="Logo">
            </div>
            <div class="user-info">
                <!-- <p><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></p> -->
                <p>Patrick Frendo</p>
                <a class="btn btn-dark" href="logout.php">Log out</a>
            </div>
        </div>
    </header>
    <div class="profile-page">
        <h1>Profile Details</h1>
        <a class="btn btn-secondary" href="logout.php">Delete Profile</a>

        <a class="btn btn-dark" href="logout.php">Log out</a>
    </div>
</body>

</html>