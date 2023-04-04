<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<title>User Profile</title>
</head>
<?php require "./php_require/header.php" ?>

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
                <h1 class="text-name">Damjan Velichkovski</h1>
                <p class="text-school">University of Wolverhampton</p>
            </div>
        </div>
        <div class="profile-card">
            <div class="profile-card-second card-design">
                <div class="profile-card-edit">
                    <h2 class="section-title">About</h2>
                    <img class="edit-button" src="./images/edit.svg" width="100%" height="100%" />
                </div>
                <p class="user-details">Bacon ipsum dolor amet ball tip buffalo short ribs pancetta ribeye burgdoggen doner pork chop kielbasa. Fatback swine venison, beef ribs jowl tenderloin hamburger capicola short ribs brisket doner salami. Beef ball tip pancetta pig frankfurter leberkas meatloaf biltong capicola beef ribs tongue rump ribeye shankle ham hock. Kevin capicola pork filet mignon. Prosciutto shank cow strip steak biltong t-bone bacon andouille cupim. Jerky ground round prosciutto, shankle burgdoggen andouille pork loin beef chicken meatball beef ribs ball tip chislic picanha doner. Filet mignon kevin beef alcatra shankle venison pork chop beef ribs ribeye ham hock biltong buffalo burgdoggen.</p>
            </div>
            <div class="profile-card-center">
                <div class="profile-card-left">
                    <div class="profile-card-third-left card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Education</h2>
                            <img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" />
                        </div>
                        <div class="university">
                            <h3 class="user-details pt-2">University of Wolverhampton</h3>
                            <h4 class="certificate">Bachelor's degree in Computer Science</h4>
                            <p class="normal-text">Sep 2022 - ongoing</p>
                        </div>
                        <div class="university">
                            <h3 class="user-details">NCC Education</h3>
                            <h4 class="certificate">Diploma in Computing</h4>
                            <p class="normal-text">Sep 2021 - Jun 2022</p>
                        </div>
                        <div class="university">
                            <h3 class="user-details">MCAST</h3>
                            <h4 class="certificate">Advanced diploma in IT(Software Development)</h4>
                            <p class="normal-text">Sep 2019 - Jun 2021</p>
                        </div>
                    </div>
                    <div class="profile-card-third-left-password card-design">
                        <div class="profile-card-edit">
                            <h2 class="section-title">Password</h2>
                            <img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" />
                        </div>
                        <p class="normal-text">Change your current password.</p>
                    </div>
                </div>
                <div class="profile-card-right">
                    <div class="profile-card-third-right card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Personal Details</h2>
                            <img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" />
                        </div>
                        <div>
                            <div class="user-details-flex pt-2">
                                <p class="user-details user-details-text-left">email@wlv.ac.uk</p>
                                <p class="user-details user-details-text-right">male&#40;he&#47;him&#41;</p>
                            </div>
                        </div>
                        <div>
                            <div class="user-details-flex">
                                <p class="user-details user-details-text-left">tbl_Address.city_town</p>
                                <p class="user-details user-details-text-right"> tbl_Address.country</p>
                            </div>
                        </div>
                        <div class="user-details-flex">
                            <p class="user-details user-details-text-left">&#43; 77 1234 56798</p>
                            <p class="user-details user-details-text-right">08/09/1991</p>
                        </div>
                    </div>
                    <div class="profile-card-forth-right card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Projects</h2>
                            <img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" />
                        </div>
                        <div class="profile-project mb-1">
                            <h3 class="user-details mt-1">Smart garage door 1</h3>
                            <p class="certificate mb-0">Using Python on Raspberry Pi and basic electric components I created an overhead garage door that can be controlled from a mobile app, with an RFID reader and by pressing a button.</p>
                            <a href="https://damjanvelichkovski.tech.blog/">https://damjanvelichkovski.tech.blog/</a>
                        </div>
                        <!-- <div>
                        <h3 class="user-details">Smart garage door 2</h3>
                        <p class="certificate">Using Python on Raspberry Pi and basic electric components I created an overhead garage door that can be controlled from a mobile app, with an RFID reader and by pressing a button.</p>
                        <a href="https://damjanvelichkovski.tech.blog/" class="normal-text">https://damjanvelichkovski.tech.blog/</a>
                    </div> -->
                    </div>
                    <div class="profile-card-last card-design">
                        <h2 class="section-title delete-text">Danger zone</h2>
                        <p class="normal-text">Once you delete your account, there is no going back. Please be certain.</p>
                        <button class="delete-button pt-2 pb-2 pl-3 pr-3 mb-2">Delete your account</button>
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