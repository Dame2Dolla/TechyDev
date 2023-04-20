function submitFormSignUp(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get form data
  const firstName = document.getElementById("givenName").value;
  const middleName = document.getElementById("middleName").value;
  const lastName = document.getElementById("familyName").value;
  const address1 = document.getElementById("address1").value;
  const address2 = document.getElementById("address2").value;
  const postCode = document.getElementById("postCode").value;
  const city = document.getElementById("city").value;
  const mobile = document.getElementById("mobileNumber").value;
  const country = document.getElementById("country").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("signup-password").value;
  const password1 = document.getElementById("signup-password1").value;
  const dob = document.getElementById("dateOfBirth").value;
  const token = document.getElementById("tokentwo").value;
  const genderDropdown = document.getElementById("gender");
  let gender = genderDropdown.value;
  if (gender === "other") {
    gender = document.getElementById("customGender").value;
  }

  // Show/hide custom gender text area based on "custom" radio button selection

  // Code explanation:
  /**
   * Created 2 objects with the Date value and stored that as seperated variables
   * Then subracted both variables together by aquiring the year.
   * If statement is created to check is the dob entered is either greater than 16 or
   *  - if it is exactly 16 than a check is done to check if user has had their 16th birthday.
   */
  const birthDate = new Date(dob);
  const today = new Date();
  const ageDiff = today.getFullYear() - birthDate.getFullYear();
  const isOver16 =
    ageDiff > 16 ||
    (ageDiff === 16 && today.getMonth() > birthDate.getMonth()) ||
    (ageDiff === 16 &&
      today.getMonth() === birthDate.getMonth() &&
      today.getDate() >= birthDate.getDate());

  if (!isOver16) {
    alert("You must be over 16 years old to register.");
    // return is used to stop the whole function.
    return;
  }
  if (password != password1) {
    alert("Passwords do not match. Please check the spelling and try again.");
  } else {
    // Send data to PHP API
    fetch("/api/signup.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        firstName: firstName,
        middleName: middleName,
        lastName: lastName,
        mobile: mobile,
        address1: address1,
        address2: address2,
        postCode: postCode,
        city: city,
        country: country,
        email: email,
        password: password,
        dob: dob,
        gender: gender,
        token: token,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "Password Incorrect") {
          alert(
            "Password must be longer than 15 characters, must have Uppercase and Lowercase and AlphaNumeric with Special Characters."
          );
        } else if (data.status === "User Exist") {
          alert("This email is already registered. Redirecting to Login page.");
          window.location.href = "index.php";
        } else if (data.status === "User Created") {
          alert("Account is successfully created.");
          window.location.href = "index.php";
        } else if (data.status === "Try again") {
          alert("Please ensure you have filled all your details.");
        } else if (data.status === "bad token") {
          alert("Token Expired. Please refresh the page and try again.");
        } else {
          alert("Something went wrong please try again.");
        }
      })
      .catch((error) => console.error(error));
  }
}

// Show/hide custom gender text area based on "custom" drop down selection
// Variables
const customGenderInput = document.querySelector(".customGenderInput");

// Function to ensure that the input custom gender gets displayed or not.
document.getElementById("gender").addEventListener("change", function () {
  const customGender = document.getElementById("customGender");
  if (this.value === "other") {
    customGender.disabled = false;
  } else {
    customGender.disabled = true;
    customGender.value = "";
  }
});

// Initialize the display state of customGenderInput
customGenderInput.disabled = true;
