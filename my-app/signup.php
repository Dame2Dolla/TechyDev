<?php require "./php_require/session.php" ?>
<?php require "./php_require/htmlheader.php" ?>
<?php require "./php_require/securitycsrf.php" ?>
<title>Signup Form</title>
</head>

<body>
	<!-- Logo header -->
	<section class="signup-logo-header">
		<img src="./images/logo_StudentMind.png" width="100%" height="100%" />
	</section>

	<!-- Background Sign Up image -->
	<section class="signup-background-image">
		<img src="./images/img_SignupGraphic.png" width="100%" height="100%" />
	</section>

	<!-- Start of SignUp Form -->
	<div id="signup-form">
		<form onsubmit="submitFormSignUp(event)" class="signup-form-official">
			<div class="form-group-signup">
				<div class="signup-fullname">
					<div>
						<label class="lbl" for="givenName"> Given Name </label>
						<input class="textbox-medium" type="text" placeholder="Given Name" id="givenName" required />
					</div>

					<div>
						<label class="lbl" for="middleName">Middle Name</label>
						<input class="textbox-medium" type="text" placeholder="Middle Name" id="middleName" />
					</div>

					<div>
						<label class="lbl" for="familyName">Family Name</label>
						<input class="textbox-medium" type="text" placeholder="Family Name" id="familyName" required />
					</div>

				</div>

				<div class="signup-emailGender">
					<div>
						<label class="lbl" for="email">Email</label>
						<input class="textbox-long" type="email" placeholder="email@gmail.com" id="email" required />
					</div>

					<div class="gender-div">
						<label class="lbl" for="gender">Gender</label>
						<div class="signup-gender">
							<div>
								<select placeholder="Select" class="textbox-small" id="gender" name="gender" required>
									<option value="" disabled selected>Select</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
									<option value="other">Other</option>
								</select>
							</div>
							<div>
								<input class="textbox-small" type="text" id="customGender" placeholder="Enter custom gender"></input>
							</div>
						</div>
					</div>

				</div>
				<div class="signup-address-DOB-mobileNumber">
					<div class="signup-address">
						<div>
							<label class="lbl" for="address">Address</label>
						</div>

						<div>
							<input class="textbox-long" type="text" placeholder="Line 1" id="address1" required />
						</div>

						<div>
							<input class="textbox-long" type="text" placeholder="Line 2" id="address2" required />
						</div>

						<div class="signup-postCodeCity">
							<input class="textbox-small" type="text" placeholder="Post Code" id="postCode" required />

							<input class="textbox-small" type="text" placeholder="City/Town" id="city" required />
						</div>

						<div>
							<select class="textbox-medium country-font" placeholder="Country" id="country" name="country">
								<option value="" disabled selected>Country</option>
								<?php require "./php_require/country.php" ?>
							</select>
						</div>
					</div>

					<div class="signup-dob-mobilenumber">
						<div>
							<label class="lbl" for="dob">Date of birth</label>
							<input class="textbox-small" type="date" id="dateOfBirth" required />
						</div>

						<div class="div-mobileNumber">
							<label class="lbl" for="mobileNumber">Mobile Number</label>
							<input class="textbox-medium" type="number" placeholder="Type here" id="mobileNumber" required />
						</div>
					</div>
				</div>

				<div class="signup-password">
					<div class="div-createPassword">
						<label class="lbl" for="createPassword">Create Password</label>
						<input class="textbox-medium" type="password" placeholder="Type here" id="signup-password" required />
					</div>

					<div>
						<label class="lbl" for="confirmPassword">Confirm Password</label>
						<input class="textbox-medium" type="password" placeholder="Type here" id="signup-password1" required />
					</div>
				</div>

				<div class="signup-buttons">
					<a class="link-backtoLogin" href="./index.php">Already have an account?</a>

					<div class="div-create-account-btn">
						<button class="create-account-btn" type="submit">Create new account</button>
					</div>
				</div>

				<!-- signup token -- Security consultant Clayton -->
				<input class="textbox-signup" type="hidden" id="tokentwo" name="token" value="<?= $_SESSION["token"]; ?>" />
			</div>
		</form>
		<!-- End of SignUp Form -->
	</div>
	<?php require "./php_require/footer.php" ?>


	<script src="scripts/signupform.js"></script>

</body>

</html>

<!-- my path http://localhost/xampp/TechyDev/my-app/signup.php -->