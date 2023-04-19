<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Test</title>
</head>

<body>
    <h1>Simulated Malicious Website</h1>
    <form onsubmit="submitFormLogin(event)" method="POST">
        <h2>Login Form</h2>
        <label for="email">Email</label>
        <input type="email" id="email" value="patar450@gmail.com">
        <label for="password">Password</label>
        <input type="password" id="password" value="n!W!6Gqe?W8n!W!6Gqe?W8">
        <input type="hidden" id="token" value="Malicious_Token_Sign_In">
        <button type="submit">Submit</button>
    </form>
    <br />
    <!-- <form onsubmit="submitFormSignUp(event)" method="POST">
        <h2>Sign Up</h2>
        <label>First Name:</label>
        <input type="text" value="First Name" id="firstName" required />
        <label>Middle Name:</label>
        <input type="text" value="Middle Name" id="middleName" />
        <label>Last Name:</label>
        <input type="text" value="Last Name" id="lastName" required />
        <label>Mobile Number:</label>
        <input type="number" value="132456789" id="mobileNumber" required />
        <label>Address Line 1:</label>
        <input type="text" value="Address 1" id="address1" required />
        <label>Address Line 2:</label>
        <input type="text" value="Address 2" id="address2" required />
        <label>Post Code</label>
        <input type="text" value="Post Code" id="postCode" required />
        <label>City/Town</label>
        <input type="text" value="City/Town" id="city" required />
        <label>Country</label>
        <input type="text" value="Country" id="country" required />
        <label>Email:</label>
        <input type="email" value="Email@example.com" id="signup-email" required />
        <label>Password:</label>
        <input type="password" value="Abc123?!" id="signup-password" required />
        <label>Date of Birth:</label>
        <input type="date" id="dateOfBirth" required />
        <label>Gender:</label>
        <input type="radio" name="gender" id="male" value="Male">
        <label for="male">Male</label>
        <input type="radio" name="gender" id="female" value="Female">
        <label for="female">Female</label>
        <input type="radio" name="gender" id="customRadio" value="Custom">
        <label for="custom">Custom</label>
        <input type="text" id="customGender" placeholder="Enter custom gender"></input>
        <input type="hidden" name="token" id="tokentwo" value="Malicious_Token" />
        <button type="submit">Submit</button>
    </form> -->
</body>
<script src="badlogindatasender.js"></script>

</html>