<?php require "./php_require/htmlheader.php" ?>
<title>Profile</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <img src="./images/icon.jpg" width="60px" height="60px" alt="Logo">
            </div>
            <div class="user-info">
                <?php error_reporting(0);
                echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
                <a class="btn btn-dark" href="logout.php">Log out</a>
            </div>
        </div>
    </header>
    <div class="profile-page">
        <h1>Profile Details</h1>
        <div class="profile-primary-details">
            <!--Photo by <a href="https://unsplash.com/@icons8?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Icons8 Team</a> on <a href="https://unsplash.com/photos/FcLyt7lW5wg?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a> -->

            <img src="./images/default_profile.jpg" class="profile-image" width="250px" height="250px"></img>

            <div class="profile-information">
                <div class="profile-primary-information-firstsection">
                    <p>Patrick&nbsp;Frendo</p>
                    <p>Email@email.com</p>
                    <p>Gender</p>
                </div>
            </div>

        </div>
        <div class="profile-secondary">
            <div class="profile-secondary-information-Bio">
                <label>Bio:</label>
                <textarea placeholder="Bio"></textarea>
            </div>
            <div class="change-password-link">
                <button type="button" class="btn btn-danger">Change Password</button>
            </div>
        </div>
        <div class="profile-buttons">
            <a class="btn btn-secondary" href="logout.php">Delete Profile</a>
            <a class="btn btn-dark" href="logout.php">Log out</a>

        </div>
</body>

</html>