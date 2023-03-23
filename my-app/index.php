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
  <section class="logo-header">
    <img src="../TechyWebsiteItems/logo_StudentMind.png" width="350px" height="200px"/>
  </section>
  <section class="quotes">
    <p class="quote-text">"Education is the most powerful weapon which you can use to change the world."</p>
    <p class="quoter-text"> - Nelson Mandela</p>
  </section>
  <section>
  <div class="form-wrapper">
    <!-- Start of LoginForm -->
    <div class="login-form">
      <form id="login-form" onsubmit="submitFormLogin(event)" method="POST">
        <div class="credential-order">
        <label class="lbl" for="email">Email</label>
        <div class="form-group">
          <input class="textbox-login" type="email" id="email" placeholder="Enter your email" name="email" required>
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

  </section>
  <section>
    <div class="image-group">
      
      <img src="../TechyWebsiteItems/img_StudentGraphic.png" width="1900px" height="400px"/>
    </div>
  </section>
  <footer>
    <img src="../TechyWebsiteItems/logo_StudentMind.png" height="60px" width="100px"/><p class="footer-logo">&#169; 2023</p>
</footer>
<script src="scripts/showpassword.js"></script>
  <script src="scripts/logindatasender.js"></script>
  <script src="scripts/signupform.js"></script>
  <script src="scripts/submitform.js"></script>
  <script src="scripts/gender.js"></script>
  <script src="scripts/forgotpassword.js"></script>
  
</body>

</html>