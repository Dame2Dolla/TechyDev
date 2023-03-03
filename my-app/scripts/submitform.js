function submitFormSignUp(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get form data
  const firstName = document.getElementById("firstName").value;
  const lastName = document.getElementById("lastName").value;
  const address1 = document.getElementById("address1").value;
  const address2 = document.getElementById("address2").value;
  const postCode = document.getElementById("postCode").value;
  const city = document.getElementById("city").value;
  const country = document.getElementById("country").value;
  const email = document.getElementById("signup-email").value;
  const password = document.getElementById("signup-password").value;
  const dob = document.getElementById("dateOfBirth").value;

  
  if (document.getElementById("male").checked) {
    gender = document.getElementById("male").value;
  } else if (document.getElementById("female").checked) {
    gender = document.getElementById("female").value;
  } else if (document.getElementById("custom").checked) {
    gender = document.getElementById("customGender").value;
  }


  // Show/hide custom gender text area based on "custom" radio button selection
  const customGenderInput = document.getElementById("customGenderInput");
  const customRadio = document.getElementById("custom");
  customRadio.addEventListener("change", function () {
    if (customRadio.checked) {
      customGenderInput.style.display = "block";
    } else {
      customGenderInput.style.display = "none";
    }
  });

  // // Calculate the difference between the date of birth and the current date
  // const ageDiffMs = Date.now() - longDob.getTime();

  // // Convert the difference to years
  // const ageDate = new Date(ageDiffMs);
  // const age = Math.abs(ageDate.getUTCFullYear() - 1970);

  // // Check if the user is older than 16 years
  // if (age < 16) {
  //   alert("You must be at least 16 years old to sign up.");
  //   return false; // Prevent the form from submitting
  // }

  // Send data to PHP API
  fetch("https://techytest23.000webhostapp.com/api/signup.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `firstName=${firstName}&lastName=${lastName}&address1=${address1}&address2=${address2}&postCode=${postCode}&city=${city}&country=${country}&email=${email}&password=${password}&dob=${dob}&gender=${gender}`,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
      if (data === "Password Incorrect") {
        alert(
          "Password must be longer than 8 characters, must have Uppercase and Lowercase and AlphaNumeric with Special Characters."
        );
      } else if (data === "User Exist") {
        alert("This email is already registered.");
      } else if (data === "User Created") {
        alert("Account is successfully created.");
      } else {
        alert("Something went wrong please try again.");
      }
    })
    .catch((error) => console.error(error));
}
