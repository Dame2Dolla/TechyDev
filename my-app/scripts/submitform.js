function submitFormSignUp(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get form data
  const firstName = document.getElementById("firstName").value;
  const middleName = document.getElementById("middleName").value;
  const lastName = document.getElementById("lastName").value;
  const address1 = document.getElementById("address1").value;
  const address2 = document.getElementById("address2").value;
  const postCode = document.getElementById("postCode").value;
  const city = document.getElementById("city").value;
  const mobile = document.getElementById("mobileNumber").value;
  const country = document.getElementById("country").value;
  const email = document.getElementById("signup-email").value;
  const password = document.getElementById("signup-password").value;
  const dob = document.getElementById("dateOfBirth").value;
  const token = document.getElementById("tokentwo").value;

  if (document.getElementById("male").checked) {
    gender = document.getElementById("male").value;
  } else if (document.getElementById("female").checked) {
    gender = document.getElementById("female").value;
  } else if (document.getElementById("custom").checked) {
    gender = document.getElementById("customGender").value;
  }

  // Show/hide custom gender text area based on "custom" radio button selection
  // const customGenderInput = document.getElementById("customGenderInput");
  // const customRadio = document.getElementById("custom");
  // customRadio.addEventListener("change", function () {
  //   if (customRadio.checked) {
  //     customGenderInput.style.display = "block";
  //   } else {
  //     customGenderInput.style.display = "none";
  //   }
  // });

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

  // Send data to PHP API
  fetch("https://techytest23.000webhostapp.com/api/signup.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `firstName=${firstName}&middleName=${middleName}&lastName=${lastName}&mobile=${mobile}&address1=${address1}&address2=${address2}&postCode=${postCode}&city=${city}&country=${country}&email=${email}&password=${password}&dob=${dob}&gender=${gender}&token=${token}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Password Incorrect") {
        alert(
          "Password must be longer than 15 characters, must have Uppercase and Lowercase and AlphaNumeric with Special Characters."
        );
      } else if (data === "User Exist") {
        alert("This email is already registered.");
        window.location.href = "index.php";
      } else if (data === "User Created") {
        alert("Account is successfully created.");
        window.location.href = "index.php";
      } else if (data === "Try again") {
        alert("Please ensure you have filled all your details.");
      } else if (data === "bad token") {
        alert("Refresh the page and try again.");
      } else {
        alert("Something went wrong please try again.");
      }
    })
    .catch((error) => console.error(error));
}
