<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<?php require "./php_require/securitycsrf.php" ?>
<title>User Profile</title>
</head>
<?php require "./php_require/header.php";
//error_reporting(0);
?>

<body class="user-profile-page">
    <div class="overlay" id="overlay"></div>
    <!-- Modal Boxes -->
    <!-- Start of Modal Box for the About section.  -->
    <div class="popup-about card-design pop-up-positioning" id="popup-about">
        <div class="popup-title-button">
            <button type="button" class="close-button" onclick="closePopup()">X</button>
        </div>
        <h5 class="section-title about-title">Edit about section</h5>
        <form id="about-form">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/aboutpopup.php'; ?>
            <button type="submit" class="change-password-button">Save</button>
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
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
        <form class="pl-3 pr-3 pb-3" id="changeDetails-form">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/changedetailspopup.php'; ?>
            <button type="submit" class="change-password-button">Save</button>
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
        </form>
    </div>
    </div>
    <!-- Start of Modal Box for confirm email -->
    <div class="popup-email-confirm card-design pop-up-positioning" id="popup-email">
        <form id="email-form">
            <div class="pt-2">
                <div class="popup-title-button">
                    <button type="button" class="close-button" onclick="closePopup()">X</button>
                </div>
                <h5 class="section-title about-title">Change email</h5>
            </div>
            <div class="popup-email-section">
                <div class="popup-details-display popup-email-label">
                    <label class="popup-personal-text">New Email</label>
                    <input type="email" id="email1" placeholder="email@email.com" class="popup-personal-text-boxes pl-3 popup-email-textbox" />
                </div>
                <div class="popup-details-display popup-email-label">
                    <label class="popup-personal-text">Confirm Email</label>
                    <input type="email" id="email2" placeholder="email@email.com" class="popup-personal-text-boxes pl-3 popup-email-textbox" />
                </div>
            </div>
            <button type="submit" class="change-password-button">Save</button>
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
        </form>
    </div>
    <!-- End of Modal Box for the Personal section.  -->
    <!-- Start of Modal Box for Password Change -->
    <div class="popup-password-change card-design pop-up-positioning" id="popup-change-password">
        <div class="popup-title-button">
            <button type="button" class="close-button" onclick="closePopup()">X</button>
        </div>
        <h5 class="section-title about-title">Change password</h5>
        <form id="password-form">
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
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
        </form>
    </div>
    <!-- End of Modal Box for Password Change -->
    <!-- Start of Modal Box for Deletion -->
    <div class="popup-deletion card-design pop-up-positioning" id="popup-delete">
        <div class="pt-2">
            <h5 class="section-title about-title">Are you sure?</h5>
        </div>
        <div class="popup-email-section">
            <p class="popup-delete-text">Once you delete your account, there is no going back. Please be certain.</p>
            <p class="popup-delete-text">Please be certain.</p>
        </div>
        <div class="button-sorting  button-sorting-extras">
            <button type="button" class="popup-close-button" onclick="closePopup()">Close</button>
            <button type="button" class="popup-deletion-button" onclick="submitDeletion(event)">Delete</button>
        </div>
    </div>
    <!-- End of Modal Box for Deletion -->
    <!-- Start of Modal Box for Education -->
    <div class="popup-education card-design pop-up-positioning" id="popup-education">
        <div class="popup-education-header pt-2">
            <button type="button" class="close-button popup-education-plus" onclick="openEducationNewPopup()">+</button>
            <h5 class="section-title">Education</h5>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/viewuniversitypopup.php'; ?>
        <button type="submit" class="change-password-button popup-education-button-done" onclick="closePopup()">Done</button>
    </div>
    <!-- End of Modal Box for Education -->
    <!-- Start of Modal Box for Add Education -->
    <div class="popup-education-add card-design pop-up-positioning" id="popup-education-add">
        <form id="new-university-form">
            <div class="popup-education-add-header pt-2">
                <button type="button" class="close-button" onclick="closePopup()">X</button>
                <h5 class="section-title">Add education</h5>
            </div>
            <label class="popup-education-university-name pl-1">School</label>
            <input type="text" id="university" class="change-password-text-label" placeholder="Name of School" required />
            <label class="popup-education-university-name pl-1">Degree</label>
            <input type="text" id="certificate" class="change-password-text-label" placeholder="Name of Certificate Earned" required />
            <div class="popup-education-date-organizer">
                <div>
                    <label class="popup-education-university-name pl-1">Start date</label>
                    <input type="date" id="startDate" class="change-password-text-label" required />
                </div>
                <div>
                    <label class="popup-education-university-name pl-1">End date</label>
                    <input type="date" id="endDate" class="change-password-text-label" required />
                </div>
            </div>
            <label>Ongoing</label>
            <label class="switch">
                <input type="checkbox" id="ongoing">
                <span class="slider round"></span>
            </label>
            <button type="submit" class="change-password-button">Save</button>
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
        </form>
    </div>
    <!-- End of Modal Box for Add Education -->
    <!-- Start of Modal Box for Edit Education -->
    <div class="popup-education-add card-design pop-up-positioning" id="popup-education-edit">
        <div class="popup-education-add-header pt-2">
            <button type="button" class="close-button" onclick="closePopup()">X</button>
            <h5 class="section-title">Edit education</h5>
        </div>
        <form id="edit-university-form">
            <label class="popup-education-university-name pl-1">School</label>
            <input type="text" id="universityEdit" class="change-password-text-label" placeholder="Name of School" required readonly="true" />
            <label class="popup-education-university-name pl-1">Degree</label>
            <input type="text" id="certificateEdit" class="change-password-text-label" placeholder="Name of Certificate Earned" required readonly="true" />
            <div class="popup-education-date-organizer">
                <div>
                    <label class="popup-education-university-name pl-1">Start date</label>
                    <input type="date" id="startDateEdit" class="change-password-text-label" required />
                </div>
                <div>
                    <label class="popup-education-university-name pl-1">End date</label>
                    <input type="date" id="endDateEdit" class="change-password-text-label" required />
                </div>
            </div>
            <label>Ongoing</label>
            <label class="switch">
                <input type="checkbox" id="ongoingEdit">
                <span class="slider round"></span>
            </label>
            <input type="hidden" id="educationId" />
            <button type="submit" class="change-password-button">Save</button>
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
        </form>
    </div>
    <!-- End of Modal Box for Edit Education -->
    <!-- Start of Modal Box for Projects -->
    <div class="popup-project card-design pop-up-positioning" id="popup-project">
        <div class="popup-education-header pt-2">
            <button type="button" class="close-button popup-education-plus" onclick="openAddProjectPopup()">+</button>
            <h5 class="section-title">Projects</h5>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/viewprojectspopup.php'; ?>
        <button type="submit" class="change-password-button popup-education-button-done" onclick="closePopup()">Done</button>
    </div>
    </div>
    <!-- End of Modal Box for Projects -->
    <!-- Start of Modal Box for the Projects section.  -->
    <div class="popup-add-projects card-design pop-up-positioning" id="popup-add-project">
        <div class="popup-title-button">
            <button type="button" class="close-button" onclick="closePopup()">X</button>
        </div>
        <h5 class="section-title about-title mb-2">Add project</h5>
        <form id="new-project-form">
            <label class="popup-education-university-name pl-1">Project name</label>
            <input type="text" id="addProjectName" class="change-password-text-label pt-2 pb-2 mb-2" placeholder="Name of project" required />
            <label class="popup-education-university-name pl-1">Description</label>
            <textarea id="addProjectDesc" class="popup-about-textarea pt-2 pb-2" placeholder="Write a short description" maxlength="255"></textarea>
            <div class="popup-project-popup-toggle mt-1">
                <label>Ongoing</label>
                <label class="switch toggle-button-project">
                    <input type="checkbox" id="addProjectIsOngoing">
                    <span class="slider round"></span>
                </label>
            </div>
            <button type="submit" class="change-password-button">Save</button>
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
        </form>
    </div>
    <!-- End of Modal Box for the Projects section.  -->
    <!-- Start of Modal Box for the Projects section.  -->
    <div class="popup-edit-projects card-design pop-up-positioning" id="popup-edit-project">
        <div class="popup-title-button">
            <button type="button" class="close-button" onclick="closePopup()">X</button>
        </div>
        <h5 class="section-title about-title mb-2">Edit project</h5>
        <form id="edit-project-form">
            <label class="popup-education-university-name pl-1">Project name</label>
            <input type="text" id="projectNameEdit" class="change-password-text-label pt-2 pb-2 mb-2" placeholder="Name of project" required />
            <label class="popup-education-university-name pl-1">Description</label>
            <textarea id="projectDescEdit" class="popup-about-textarea pt-2 pb-2" placeholder="Write a short description" maxlength="255"></textarea>
            <div class="popup-project-popup-toggle mt-1">
                <label>Ongoing</label>
                <label class="switch toggle-button-project">
                    <input type="checkbox" id="projectOngoingEdit">
                    <span class="slider round"></span>
                </label>
            </div>
            <input type="hidden" id="projectId" />
            <button type="submit" class="change-password-button">Save</button>
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
        </form>
    </div>
    <!-- End of Modal Box for the Projects section.  -->
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
            </div>
        </div>
        <div class="profile-card">
            <div class="profile-card-second card-design">
                <div class="profile-card-edit">
                    <h2 class="section-title">About</h2>
                    <img class="edit-button" src="./images/edit.svg" width="100%" height="100%" onclick="openAboutPopup()" />
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/about.php'; ?>
            </div>
            <div class="profile-card-center">
                <div class="profile-card-left">
                    <div class="profile-card-third-left card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Education</h2>
                            <img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" onclick="openEducationPopup()" />
                        </div>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/education.php'; ?>
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
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/personaldetails.php'; ?>
                    </div>
                    <div class="profile-card-forth-right card-design">
                        <div class="profile-card-edit-half">
                            <h2 class="section-title">Projects</h2>
                            <img class="edit-button-half" src="./images/edit.svg" width="100%" height="100%" onclick="openProjectPopup()" />
                        </div>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/api/userdetails/projects.php'; ?>
                    </div>
                </div>
                <div class="profile-card-last card-design">
                    <h2 class="section-title delete-text">Danger zone</h2>
                    <p class="normal-text">Once you delete your account, there is no going back. Please be certain.</p>
                    <button class="delete-button pt-2 pb-2 pl-3 pr-3 mb-2" onclick="openDeletePopup()">Delete your account</button>
                </div>
            </div>
            <hr class="w-100">
            <?php require "./php_require/footer.php" ?>
        </div>
    </div>
    <script src="scripts/userprofile.js"></script>
</body>

</html>