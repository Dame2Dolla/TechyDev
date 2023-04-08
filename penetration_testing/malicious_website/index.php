<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<?php require "./php_require/securitycsrf.php" ?>
<title>Log in Form</title>
</head>

<body>
  <div class="main-content-index">
    <!-- Start of Modal Box for the Forgot password.  -->
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
      <div class="popup-title-button">
        <button type="button" class="close-button" onclick="closePopup()">X</button>
      </div>
      <h5 class="modal-title" id="forgot-password-modal-label">Forgot Password?</h5>
      <form id="forgot-password-form" onsubmit="submitFormForgotPassword(event)">
        <div class="form-group-forgot-password">
          <label for="forgot-password-email">Email address:</label>
          <input type="email" class="form-control" id="forgot-password-email" placeholder="Enter email" required />
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
      </form>
    </div>
    <!-- End of Modal Box for the Forgot password.  -->
    <!-- Start of Modal Box for the Change password.  -->
    <div class="popup-change-password" id="popup-change-password">
      <h5 class="modal-title-change-password">Welcome back to our website!</h5>
      <form onsubmit="submitFormChangePassword(event)">
        <p class="modal-change-password-message">We value your security and want to ensure that your account remains safe. We noticed that your current password has expired after 90 days. Please take a moment to create a new password to continue using our services. Thank you for helping us maintain a secure environment for all of our users.</p>
        <div class="modal-change-password-password-section">
          <label class="change-password-text">New password</label>
          <div class="input-eye-wrapper">
            <input type="password" id="password1" class="change-password-text-label" placeholder="***************" required />
            <img src="./images/eye.svg" id="toggle-password1" class="change-password-eye" />
          </div>
          <label class="change-password-text">Confirm new password</label>
          <div class="input-eye-wrapper">
            <input type="password" id="password2" class="change-password-text-label" placeholder="***************" required />
            <img src="./images/eye.svg" id="toggle-password2" class="change-password-eye" />
          </div>
        </div>
        <button type="submit" class="change-password-button">Save</button>
      </form>
    </div>
    <!-- End of Modal Box for the Change password.  -->
    <div class="main-content-login">
      <div class="main-content-left">
        <img src="./images/logo_StudentMind.png" class="logo-header" width="100%" height="100%" />
        <div class="quotes">
          <p class="quote-text">"Education is the most powerful weapon which you can use to change the world."</p>
          <p class="quoter-text"> - Nelson Mandela</p>
        </div>
      </div>
      <!-- Start of LoginForm -->
      <div class="login-form">
        <form id="login-form" onsubmit="submitFormLogin(event)" method="POST">
          <div class="credential-order">
            <label class="lbl" for="email">Email</label>
            <div class="form-group">
              <input class="textbox-login" type="text" id="email" placeholder="Enter your email" name="email" required>
            </div>
            <label class="lbl" for="password">Password</label>
            <div class="form-group">
              <div class="eye-dropper">
                <input class="textbox-login" type="password" id="password" placeholder="Enter your password" name="password" required>
                <button class="btn password-icon" type="button"><i class="fa fa-eye"></i></button>
              </div>
            </div>
          </div>
          <div class="form-order">
            <div class="form-group form-check form-inline">
              <input type="checkbox" class="form-check-input" id="remember-me">
              <label class="form-check-label" for="remember-me">Remember me</label>
            </div>
            <button type="button" class="btn forgot-password" id="forgot-password-button" onclick="openPopup()">Forgot Password?</button>
            <button type="submit" class="btn-login">Log In</button>
            <p class="or">Or</p>
            <a href="./signup.php">
              <button type="button" class="btn-signup" id="signup-button">Sign Up</button>
            </a>
          </div>
          <!-- signin token -- Security consultant Clayton -->
          <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
        </form>
        <!-- End of LoginForm -->
      </div>
    </div>
    <img src="./images/img_StudentGraphic.png" class="image-group" width="100%" height="100%" />
  </div>

  <?php require "./php_require/footer.php" ?>
  <script src="scripts/showpassword.js"></script>
  <script src="scripts/logindatasender.js"></script>
  <script src="scripts/forgotpassword.js"></script>
</body>

</html>