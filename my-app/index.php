<?php require "./php_require/session.php"?>
<?php require "./php_require/htmlheader.php" ?>
<?php require "./php_require/securitycsrf.php"?>
<title>Log in Form</title>
</head>

<body>
  
    <!-- Start Modal Box for the Forgot password. -->
    <div class="modal fade" id="forgot-password-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="forgot-password-modal-label">Forgot Password?</h5>
            <div id="message"></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="forgot-password-form" onsubmit="submitFormForgotPassword(event)">
              <div class="form-group">
                <label for="forgot-password-email">Email address:</label>
                <input type="email" class="form-control" id="forgot-password-email" placeholder="Enter email" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Modal Box for the Forgot password.  -->
    <!-- Start of LoginForm -->
    <div class="form-wrapper">
      <div class="login-form">
        <form id="login-form" onsubmit="submitFormLogin(event)" method="POST">
          <div class="form-group">
            <label for="email">Email:</label>
            <input class="input-text" type="email" id="email" placeholder="Enter your email" name="email" required>
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
          <button type="button" class="btn btn-success btn-block" id="signup-button">Sign Up</button>
          <button type="button" class="btn btn-link" id="forgot-password-button">Forgot Password?</button>
           <!-- signin token -- Security consultant Clayton --> 
          <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"];?>" />
        </form>
        <!-- End of LoginForm -->
        <!-- Start of SignUp Form -->
        <div id="signup-form">
          <form onsubmit="submitFormSignUp(event)" class="signup-form-official">
            <h2 class="text-center title">Sign Up</h2>
            <div class="form-group">
              <label>First Name:</label>
              <input type="text" class="form-control" placeholder="First Name" id="firstName" required />
            </div>
            <div class="form-group">
              <label>Middle Name:</label>
              <input type="text" class="form-control" placeholder="Middle Name" id="middleName" required />
            </div>
            <div class="form-group">
              <label>Last Name:</label>
              <input type="text" class="form-control" placeholder="Last Name" id="lastName" required />
            </div>
            <div class="form-group">
              <label>Mobile Number:</label>
              <input type="number" class="form-control" placeholder="Number" id="mobileNumber" required />
            </div>
            <div class="form-group">
              <label>Address Line 1:</label>
              <input type="text" class="form-control" placeholder="Address 1" id="address1" required />
            </div>
            <div class="form-group">
              <label>Address Line 2:</label>
              <input type="text" class="form-control" placeholder="Address 2" id="address2" required />
            </div>
            <div class="form-group">
              <label>Post Code</label>
              <input type="text" class="form-control" placeholder="Post Code" id="postCode" required />
            </div>
            <div class="form-group">
              <label>City/Town</label>
              <input type="text" class="form-control" placeholder="City/Town" id="city" required />
            </div>
            <div class="form-group">
              <label>Country</label>
              <input type="text" class="form-control" placeholder="Country" id="country" required />
            </div>
            <div class="form-group">
              <label>Email:</label>
              <input type="email" class="form-control" placeholder="Email@example.com" id="signup-email" required />
            </div>
            <div class="form-group">
              <label>Password:</label>
              <input type="password" class="form-control" placeholder="Abc123?!" id="signup-password" required />
            </div>
            <div class="form-group">
              <label>Date of Birth:</label>
              <input type="date" class="form-control" id="dateOfBirth" required />
            </div>
            <div class="form-group">
              <label>Gender:</label>
              <div>
                <input type="radio" name="gender" id="male" value="Male">
                <label for="male">Male</label>
              </div>
              <div>
                <input type="radio" name="gender" id="female" value="Female">
                <label for="female">Female</label>
              </div>
              <div>
                <input type="radio" name="gender" id="custom" value="Custom">
                <label for="custom">Custom</label>
              </div>
              <div id="customGenderInput">
                <input type="text" id="customGender" placeholder="Enter custom gender"></input>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <!-- signup token -- Security consultant Clayton --> 
            <input type="hidden" id="token" name="token" value="<?= $_SESSION["token"];?>" />
          </form>
          <!-- End of SignUp Form -->
        </div>
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