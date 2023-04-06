<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<title>User Profile</title>
</head>
<?php require "./php_require/header.php" ?>

<body class="user-profile-page">
    <div class="overlay" id="overlay"></div>
    <!-- Modal Boxes -->
    <!-- Start of Modal Box for the About section.  -->
    <div class="popup-about card-design pop-up-positioning" id="popup-about">
        <div class="popup-title-button">
            <button type="button" class="close-button" onclick="closePopup()">X</button>
        </div>
        <h5 class="section-title about-title">Edit about section</h5>
        <form>
            <textarea class="popup-about-textarea" placeholder="Write here..." maxlength="255">wxkRf10O9NdRy13mSDk7Jm0Nu1Ux4zIcMjjo0gpHiV3tuNpOfIqa3L29OmQxa2lgRbBl2D4jslwvEYwidLTV0vOtjHwj2XuxBxVCsokkBuyQEOhlCrju1NjPB5hGmQB2ExbXqnYn6iEhrnkbA0gvuc3CEA6dULBQ5Vf51UgEJMmh3dVyN4Cb2IV8Raim3L8H4rXvNseZlO5TkijGnsW25a64DjNCgm8PI7a2rA5yynJx4lvq034F75r3baELRwj</textarea>
            <button type="submit" class="change-password-button">Save</button>
        </form>
    </div>
    <!-- End of Modal Box for the About section.  -->
    <!-- Start of Modal Box for the Personal section.  -->
    <div class="popup-personal-details card-design pop-up-positioning" id="popup-personal">
        <div class="pt-2">
            <div class="popup-title-button">
                <button type="button" class="close-button" onclick="closePopup()">X</button>
            </div>
            <h5 class="section-title about-title">Edit your personal details</h5>
        </div>
        <form class="pl-3 pr-3 pb-3">
            <div class="popup-personal-details-display">
                <div class="popup-details-display">
                    <label class="popup-personal-text">Given name</label>
                    <input type="text" placeholder="First Name" class="popup-personal-text-boxes pl-3" />
                </div>
                <div class="popup-details-display">
                    <label class="popup-personal-text">Middle name</label>
                    <input type="text" placeholder="Middle Name" class="popup-personal-text-boxes pl-3" />
                </div>
                <div class="popup-details-display">
                    <label class="popup-personal-text">Last name</label>
                    <input type="text" placeholder="Last Name" class="popup-personal-text-boxes pl-3" />
                </div>
            </div>
            <div class="popup-personal-details-display">
                <div class="popup-details-display">
                    <label class="popup-personal-text">Mobile number</label>
                    <input type="text" placeholder="+00 0000 0000" class="popup-personal-text-boxes pl-3" />
                </div>
                <div>
                    <label class="popup-personal-text">Gender</label>
                    <div>
                        <select name="gender" class="popup-personal-text-boxes pl-3">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="custom">Custom</option>
                        </select>
                        <input type="text" placeholder="Custom gender" class="popup-personal-text-boxes pl-3" />
                    </div>
                </div>
            </div>
            <label class="popup-personal-text">Address</label>
            <div class="popup-details-display">
                <div class="popup-personal-details-display">
                    <input type="text" placeholder="Line 1" class="popup-personal-text-boxes pl-3" />
                    <input type="text" placeholder="Line 2" class="popup-personal-text-boxes pl-3" />
                    <input type="text" placeholder="City" class="popup-personal-text-boxes pl-3" />
                </div>
                <div class="popup-country">
                    <input type="text" placeholder="PostCode" class="popup-personal-text-boxes pl-3" />
                    <select id="country" name="country" class="popup-personal-text-boxes pl-3">
                        <?php require "./php_require/country.php" ?>
                    </select>
                </div>
            </div>
            <div class="button-sorting">
                <button type="button" class="change-email-button" onclick="openEmailPopup()">Change email</button>
                <button type="submit" class="change-password-button">Save</button>
            </div>
        </form>
    </div>
    <!-- Start of Modal Box for confirm email -->
    <div class="popup-email-confirm card-design pop-up-positioning" id="popup-email">
        <div class="pt-2">
            <div class="popup-title-button">
                <button type="button" class="close-button" onclick="closePopup()">X</button>
            </div>
            <h5 class="section-title about-title">Change email</h5>
        </div>
        <div class="popup-email-section">
            <div class="popup-details-display popup-email-label">
                <label class="popup-personal-text">New Email</label>
                <input type="text" placeholder="email@email.com" class="popup-personal-text-boxes pl-3 popup-email-textbox" />
            </div>
            <div class="popup-details-display popup-email-label">
                <label class="popup-personal-text">Confirm Email</label>
                <input type="text" placeholder="email@email.com" class="popup-personal-text-boxes pl-3 popup-email-textbox" />
            </div>
        </div>
        <button type="submit" class="change-password-button">Save</button>
    </div>
    <!-- End of Modal Box for the Personal section.  -->
    <!-- Start of Modal Box for Password Change -->
    <div class="popup-password-change card-design pop-up-positioning" id="popup-change-password">
        <div class="popup-title-button">
            <button type="button" class="close-button" onclick="closePopup()">X</button>
        </div>
        <h5 class="section-title about-title">Change password</h5>
        <form>
            <div class="modal-change-password-password-section">
                <label class="change-password-text">Old password</label>
                <div class="input-eye-wrapper">
                    <input type="password" id="oldpassword" class="change-password-text-label" placeholder="***************" required />
                    <img src="./images/eye.svg" id="toggle-oldpassword" class="change-password-eye popup-password-change-eye-wrapper" />
                </div>
                <label class="change-password-text">New password</label>
                <div class="input-eye-wrapper">
                    <input type="password" id="password1" class="change-password-text-label" placeholder="***************" required />
                    <img src="./images/eye.svg" id="toggle-password1" class="change-password-eye popup-password-change-eye-wrapper" />
                </div>
                <label class="change-password-text">Confirm new password</label>
                <div class="input-eye-wrapper">
                    <input type="password" id="password2" class="change-password-text-label" placeholder="***************" required />
                    <img src="./images/eye.svg" id="toggle-password2" class="change-password-eye popup-password-change-eye-wrapper" />
                </div>
            </div>
            <button type="submit" class="change-password-button">Save</button>
        </form>
    </div>
    <!-- End of Modal Box for Password Change -->
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
                    <img class="edit-button" src="./images/edit.svg" width="100%" height="100%" onclick="openAboutPopup()" />
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
                            <img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" onclick="openPasswordPopup()" />
                        </div>
                        <p class="normal-text">Change your current password.</p>
                    </div>
                </div>
                <div class="profile-card-right">
                    <div class="profile-card-third-right card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Personal Details</h2>
                            <img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" onclick="openPersonalPopup()" />
                        </div>
                        <div>
                            <div class=" user-details-flex pt-2">
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