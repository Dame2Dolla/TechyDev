<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<?php require "./php_require/securitycsrf.php" ?>
<title>Log in Form</title>
</head>

<body>
  <!-- Start of Modal Box for the Forgot password.  -->
  <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
      <div class="popup-title">
      <button type="button" class="close-button" onclick="closePopup()">X</button>
    </div>
      <h5 class="modal-title" id="forgot-password-modal-label">Forgot Password?</h5>
      <form id="forgot-password-form" onsubmit="submitFormForgotPassword(event)">
              <div class="form-group-forgot-password">
                <label for="forgot-password-email">Email address:</label>
                <input type="email" class="form-control" id="forgot-password-email" placeholder="Enter email" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
    </div>
    <!-- End of Modal Box for the Forgot password.  -->
  <div class="form-wrapper">
      <!-- Start of LoginForm -->
    <div class="login-form">
      <h1>Login</h1>
      <form id="login-form" onsubmit="submitFormLogin(event)" method="POST">
        <div class="form-group">
          <label for="email">Email:</label>
          <input class="input" type="email" id="email" placeholder="Enter your email" name="email" required>
        </div>
        <div class="form-group ">
          <label for="password">Password:</label>
          <div class="password-wrapper">
            <input type="password" id="password" placeholder="Enter your password" name="password" required>
            <button class="btn password-icon" type="button"><i class="fa fa-eye"></i></button>
          </div>
        </div>
        <div class="form-group form-check form-inline">
          <input type="checkbox" class="form-check-input" id="remember-me">
          <label class="form-check-label" for="remember-me">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Log In</button>
        <a href="./signup.php">
          <button type="button" class="btn btn-success btn-block" id="signup-button">Sign Up</button>
        </a>
        <button type="button" class="btn btn-link" id="forgot-password-button" onclick="openPopup()">Forgot Password?</button>
        <!-- signin token -- Security consultant Clayton -->
        <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"]; ?>" />
      </form>
      <!-- End of LoginForm -->
      <!-- Footer -->
      <footer class="text-center">Studentmind.xyz &copy; 2023</footer>
    </div>
  </div>

  
  <script src="scripts/showpassword.js"></script>
  <script src="scripts/logindatasender.js"></script>
  <script src="scripts/signupform.js"></script>
  <script src="scripts/submitform.js"></script>
  <script src="scripts/gender.js"></script>
  <script src="scripts/forgotpassword.js"></script>
  
</body>

</html>