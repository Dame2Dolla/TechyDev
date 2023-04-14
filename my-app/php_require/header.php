<header>
    <div class="header">
        <div class="logo">
            <!-- <a href="./newsfeed.php"> -->
            <img src="./images/logo_StudentMind.png" width="100%" height="100%" alt="Logo">
            <!-- </a> -->
        </div>
        <div class="search">
            <form action="useroverview.php" method="POST">
                <img class="search-icon" src="./images/search-icon.svg" width="100%" height="100%" />
                <input type="text" class="search-text-box" placeholder="Search.." name="search" id="search-input">
            </form>
        </div>
        <img class="user-profile-image-header" src="./images/default_profile.jpg" width="100%" height="100%" />
    </div>
    <div class="sub-menu">
        <div class="sub-menu-items">
            <div class="sub-menu-items-img">
                <img src="./images/default_profile.jpg" width="100%" height="100%" />
            </div>
            <div class="sub-menu-items-text">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/headerapi/username.php'; ?>
            </div>
        </div>
        <div class="sub-menu-button">
            <button class="sub-menu-profile button-text" id="homepage-btn">View your profile</button>
            <hr class="sub-menu-button-line">
            <button class="sub-menu-logout button-text" onclick="logout()">Log out</button>
        </div>
    </div>
    <script src="scripts/header.js"></script>
    <script src="scripts/logout.js"></script>
</header>