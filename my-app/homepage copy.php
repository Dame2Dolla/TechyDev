<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<title>Profile</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <a href="./homepage.php">
                    <img src="./images/logo_StudentMind.png" width="97px" height="55px" alt="Logo">
                </a>
            </div>
            <div class="user-info">
                <!-- <div class="user-info-name-details">
                    <?php error_reporting(0);
                    echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
                </div> -->

                <img class="user-profile-image-header" src="./images/default_profile.jpg" width="50px" height="50px" />
                <a class="btn btn-dark" onclick="logout()" href="#">^</a>
            </div>
        </div>
        </div>
    </header>
    <div class="profile-page">
        <h1>Profile Details</h1>
        <div class="profile-primary-details">
            <!--Photo by <a href="https://unsplash.com/@icons8?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Icons8 Team</a> on <a href="https://unsplash.com/photos/FcLyt7lW5wg?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a> -->

            <img src="./images/default_profile.jpg" class="profile-image" width="250px" height="250px"></img>

            <div class="profile-primary-information">
                <form id="primary-details" onsubmit="submitPrimaryDetailsChange(event)" method="POST">
                    <input type="text" id="firstName" placeholder="<?= $_SESSION['first_name'] ?>" name="firstname" />
                    <input type="text" id="lastName" placeholder="<?= $_SESSION['last_name'] ?>" name="lastname" />
                    <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
                    <button class="btn btn-primary ml-2 mb-4 mt-2" type="submit">Change these details</button>
                </form>
            </div>
        </div>
        <div class="profile-buttons">

        </div>
        <a class="btn btn-secondary" onclick="submitDeletion()" href="#">Delete Profile</a>
        <a class="btn btn-dark" onclick="logout()" href="#">Log out</a>

        <script src="scripts/logout.js"></script>
        <script src="scripts/deleteprofile.js"></script>
        <script src="scripts/changedetails.js"></script>
</body>

</html>