<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<?php require "./php_require/securitycsrf.php" ?>
<title>Signup Form</title>
</head>

<body>
    <div class="sign-up-background">
        <!-- Start of SignUp Form -->
        <div id="signup-form">
            <form onsubmit="submitFormSignUp(event)" class="signup-form-official">
                <h2 class="text-center title">Sign Up</h2>
                <div class="form-group-signup">
                    <div class="form-group-signup-inputs">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" class="form-control" placeholder="First Name" id="firstName" required />
                        </div>
                        <div class="form-group">
                            <label>Middle Name:</label>
                            <input type="text" class="form-control" placeholder="Middle Name" id="middleName" />
                        </div>
                    </div>
                    <div class="form-group-signup-inputs">

                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" class="form-control" placeholder="Last Name" id="lastName" required />
                        </div>
                        <div class="form-group">
                            <label>Mobile Number:</label>
                            <input type="number" class="form-control" placeholder="Number" id="mobileNumber" required />
                        </div>
                    </div>
                    <div class="form-group-signup-inputs">

                        <div class="form-group">
                            <label>Address Line 1:</label>
                            <input type="text" class="form-control" placeholder="Address 1" id="address1" required />
                        </div>
                        <div class="form-group">
                            <label>Address Line 2:</label>
                            <input type="text" class="form-control" placeholder="Address 2" id="address2" required />
                        </div>
                    </div>
                    <div class="form-group-signup-inputs">

                        <div class="form-group">
                            <label>Post Code</label>
                            <input type="text" class="form-control" placeholder="Post Code" id="postCode" required />
                        </div>
                        <div class="form-group">
                            <label>City/Town</label>
                            <input type="text" class="form-control" placeholder="City/Town" id="city" required />
                        </div>
                    </div>
                    <div class="form-group-signup-inputs">

                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" placeholder="Country" id="country" required />
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" placeholder="Email@example.com" id="signup-email" required />
                        </div>
                    </div>
                    <div class="form-group-signup-inputs">

                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" placeholder="Abc123?!" id="signup-password" required />
                        </div>
                        <div class="form-group">
                            <label>Date of Birth:</label>
                            <input type="date" class="form-control" id="dateOfBirth" required />
                        </div>
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
                            <input type="radio" name="gender" id="customRadio" value="Custom">
                            <label for="custom">Custom</label>
                        </div>
                        <div class="customGenderInput">
                            <input type="text" class="form-control" id="customGender" placeholder="Enter custom gender"></input>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <a href="./index.php">
                        <button type="button" class="btn btn-success btn-block" id="signup-button">Back to log in</button>
                    </a>
                    <!-- signup token -- Security consultant Clayton -->
                    <input type="hidden" id="tokentwo" name="token" value="<?= $_SESSION["token"]; ?>" />
                </div>
                <!-- Footer -->
                <footer class="text-center mt-2">Studentmind.xyz &copy; 2023</footer>
            </form>
            <!-- End of SignUp Form -->
        </div>
    </div>
    </div>

    <script src="scripts/signupform.js"></script>
    <script src="scripts/submitform.js"></script>
    <script src="scripts/gender.js"></script>
    </div>
</body>

</html>