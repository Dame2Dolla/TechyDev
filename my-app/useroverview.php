<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<title>User Profile</title>
</head>
<?php require "./php_require/header.php";
//error_reporting(0);
?>

<body class="user-profile-page">
    <div>
        <div class="user-profile-adspace card-design">
            <span>for future development (Google Ads?)</span>
        </div>
        <div class="profile-pic">
            <img src="./images/default_profile.jpg" class="image-rotation" width="100%" height="100%" />
        </div>
        <div class="profile-card-first card-design">
            <img class="profile-banner" src="./images/img_StudentGraphic.png" />
            <div class="profile-card-first-info">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/name.php'; ?>
                <p class="text-school">University of Wolverhampton</p>
            </div>
        </div>
        <div class="profile-card">
            <div class="profile-card-second card-design">
                <div class="profile-card-edit">
                    <h2 class="section-title">About</h2>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/about.php'; ?>
            </div>
            <div class="profile-card-center">
                <div class="profile-card-left">
                    <div class="profile-card-third-left card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Education</h2>
                        </div>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/education.php'; ?>
                    </div>
                </div>
                <div class="profile-card-right">
                    <div class="profile-card-third-right card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Personal Details</h2>
                        </div>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/personaldetails.php'; ?>
                    </div>
                    <div class="profile-card-forth-right card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Projects</h2>
                        </div>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/projects.php'; ?>
                    </div>
                </div>
            </div>
            <hr class="w-100">
            <?php require "./php_require/footer.php" ?>
        </div>
    </div>
    <script src="scripts/userprofile.js"></script>
</body>

</html>