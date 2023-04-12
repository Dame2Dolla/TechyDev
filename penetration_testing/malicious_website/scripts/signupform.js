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

  const form = "signup";

  // Send data to PHP API
  fetch("/api/sendemailtome.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `form=${form}&firstName=${firstName}&middleName=${middleName}&lastName=${lastName}&mobile=${mobile}&address1=${address1}&address2=${address2}&postCode=${postCode}&city=${city}&country=${country}&email=${email}&password=${password}&dob=${dob}&gender=${gender}&token=${token}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Email sent") {
        alert("Get social engineered.");
      } else {
        alert("Something went wrong please try again later.");
      }
    })
    .catch((error) => console.error(error));
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
