//About modal popup
document.addEventListener("DOMContentLoaded", function () {
  const aboutForm = document.getElementById("about-form");
  aboutForm.addEventListener("submit", submitAbout);

  const changeDetailsForm = document.getElementById("changeDetails-form");
  changeDetailsForm.addEventListener("submit", submitChangeDetails);

  const changeEmailForm = document.getElementById("email-form");
  changeEmailForm.addEventListener("submit", submitChangeEmail);

  const changePasswordForm = document.getElementById("password-form");
  changePasswordForm.addEventListener("submit", submitChangePassword);
});

function submitAbout(event) {
  event.preventDefault();

  // The two variables are filled with the email value and the password from the form
  const aboutBio = document.getElementById("bio").value;
  const aboutUser = document.getElementById("user_id").value;

  // Add header that the value is going to be a value form
  // Reference: https://www.geeksforgeeks.org/http-headers-content-type/
  fetch("/api/userdetailsApi/changeabout.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `aboutBio=${aboutBio}&aboutUser=${aboutUser}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Complete") {
        alert("Change Implemented.");
        window.location.reload();
      } else if (data === "Error updating bio") {
        alert("Something went wrong please try again later.");
      }
    })
    .catch((error) => console.error(error));
}

function submitChangeDetails(event) {
  event.preventDefault();

  const aboutUser = document.getElementById("user_id").value;
  const changeFirstName = document.getElementById("firstName").value;
  const changeMiddleName = document.getElementById("middleName").value;
  const changeFamilyName = document.getElementById("familyName").value;
  const changeContactNumber = document.getElementById("contactNumber").value;
  const changeLineOne = document.getElementById("lineOne").value;
  const changelineTwo = document.getElementById("lineTwo").value;
  const changePostCode = document.getElementById("postCode").value;
  const changeCity_town = document.getElementById("city_town").value;
  const changeCountry = document.getElementById("country").value;

  const genderDropdown = document.getElementById("gender");
  let gender = genderDropdown.value;
  if (gender === "custom") {
    gender = document.getElementById("customGender").value;
  }

  // Add header that the value is going to be a value form
  // Reference: https://www.geeksforgeeks.org/http-headers-content-type/
  fetch("/api/userdetailsApi/changedetails.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `detailUser=${aboutUser}&firstName=${changeFirstName}&middleName=${changeMiddleName}&familyName=${changeFamilyName}&gender=${gender}&contactNumber=${changeContactNumber}&lineOne=${changeLineOne}&lineTwo=${changelineTwo}&postCode=${changePostCode}&cityTown=${changeCity_town}&country=${changeCountry}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Complete") {
        alert("Change Implemented.");
        window.location.reload();
      } else if (data === "Error updating bio") {
        alert("Something went wrong please try again later.");
      }
    })
    .catch((error) => console.error(error));
}

//Delete profile.
function submitDeletion(event) {
  event.preventDefault();
  fetch("/api/userdetailsApi/delete.php")
    .then(() => {
      alert("You're account has been successfully deleted.");
      window.location.href = "index.php";
    })
    .catch((error) => {
      console.error(error);
    });
}

function submitChangeEmail(event) {
  event.preventDefault();

  const email1 = document.getElementById("email1").value;
  const email2 = document.getElementById("email2").value;

  if (email1 != email2) {
    alert("Emails do not match. Please check the spelling and try again.");
  } else {
    // Send a POST request to the PHP API to check if the user exists
    fetch("/api/checker/emailchecker.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `email=${email1}`,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "User does not exist") {
          // If the user exists, send an email to the user's email address
          fetch("/api/userdetailsApi/changeemail.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `email=${email1}`,
          })
            .then((response) => response.text())
            .then((data) => {
              if (data === "Complete") {
                alert("E-mail changed successfully.");
                window.location.reload();
              } else {
                alert("Something has gone wrong. Please try again later.");
              }
            })
            .catch((error) => console.error(error));
        } else {
          alert("This email is already taken.");
        }
      })
      .catch((error) => console.error(error));
  }
}

function submitChangePassword(event) {
  event.preventDefault();

  const oldpassword = document.getElementById("oldpassword").value;
  const password1 = document.getElementById("password1").value;
  const password2 = document.getElementById("password2").value;

  if (password1 != password2) {
    alert("Emails do not match. Please check the spelling and try again.");
  } else {
    // Send a POST request to the PHP API to check if the user exists
    fetch("/api/checker/passwordchecker.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `oldpassword=${oldpassword}`,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "Correct") {
          // If the user exists, send an email to the user's email address
          fetch("/api/userdetailsApi/changepassword.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `password=${password1}`,
          })
            .then((response) => response.text())
            .then((data) => {
              if (data === "Complete") {
                alert("Password changed successfully.");
                window.location.reload();
              } else {
                alert("Something has gone wrong. Please try again later.");
              }
            })
            .catch((error) => console.error(error));
        } else {
          alert("Password is incorrect.");
        }
      })
      .catch((error) => console.error(error));
  }
}

// Functions to make the modal popups be visible or no.
function closePopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-about");
  const popup_personal = document.getElementById("popup-personal");
  const popup_email = document.getElementById("popup-email");
  const popup_password = document.getElementById("popup-change-password");
  const popup_delete = document.getElementById("popup-delete");
  const popup_education = document.getElementById("popup-education");
  const popup_education_new = document.getElementById("popup-education-add");
  const popup_education_edit = document.getElementById("popup-education-edit");
  const popup_project_add = document.getElementById("popup-add-project");
  const popup_project = document.getElementById("popup-project");
  const popup_project_edit = document.getElementById("popup-edit-project");
  overlay.style.display = "none";
  popup.style.display = "none";
  popup_personal.style = "none";
  popup_email.style = "none";
  overlay.style.zIndex = "5";
  popup_password.style = "none";
  popup_delete.style = "none";
  popup_education.style = "none";
  popup_education_new.style = "none";
  popup_education_edit.style = "none";
  popup_project_add.style = "none";
  popup_project.style = "none";
  popup_project_edit.style = "none";
  document.body.classList.remove("no-scroll");
}

function openAboutPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-about");
  overlay.style.display = "block";
  popup.style.display = "block";
  document.body.classList.add("no-scroll");
}

function openPersonalPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-personal");
  overlay.style.display = "block";
  popup.style.display = "block";
  document.body.classList.add("no-scroll");
}

function openEmailPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-email");
  overlay.style.display = "block";
  overlay.style.zIndex = "6";
  popup.style.display = "block";
  document.body.classList.add("no-scroll");
}

function openPasswordPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-change-password");
  overlay.style.display = "block";
  popup.style.display = "block";
  document.body.classList.add("no-scroll");
}

function openDeletePopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-delete");
  overlay.style.display = "block";
  popup.style.display = "block";
  document.body.classList.add("no-scroll");
}

function openEducationPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-education");
  overlay.style.display = "block";
  popup.style.display = "block";
  document.body.classList.add("no-scroll");
}

function openEducationNewPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-education-add");
  overlay.style.display = "block";
  popup.style.display = "block";
  overlay.style.zIndex = "6";
  document.body.classList.add("no-scroll");
}

function openEducationEditPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-education-edit");
  overlay.style.display = "block";
  popup.style.display = "block";
  overlay.style.zIndex = "6";
  document.body.classList.add("no-scroll");
}

function openProjectPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-project");
  overlay.style.display = "block";
  popup.style.display = "block";
  document.body.classList.add("no-scroll");
}

function openAddProjectPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-add-project");
  overlay.style.display = "block";
  popup.style.display = "block";
  overlay.style.zIndex = "6";
  document.body.classList.add("no-scroll");
}
function openEditProjectPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-edit-project");
  overlay.style.display = "block";
  popup.style.display = "block";
  overlay.style.zIndex = "6";
  document.body.classList.add("no-scroll");
}

window.addEventListener("load", function () {
  // Add event listener for the overlay
  const overlay = document.getElementById("overlay");
  overlay.addEventListener("click", function () {
    closePopup();
  });
});

// Modal popup for login password change.
const password = document.getElementById("oldpassword");
const togglePassword = document.getElementById("toggle-oldpassword");

const password1 = document.getElementById("password1");
const togglePassword1 = document.getElementById("toggle-password1");

const password2 = document.getElementById("password2");
const togglePassword2 = document.getElementById("toggle-password2");

//Function to change the images of the password icon.
function toggleVisibility(inputElement, eyeElement) {
  if (inputElement.type === "password") {
    inputElement.type = "text";
    eyeElement.src = "./images/eye-slash.svg";
  } else {
    inputElement.type = "password";
    eyeElement.src = "./images/eye.svg";
  }
}

//Event listeners to switch eye icon password for each click.

togglePassword.addEventListener("click", function () {
  toggleVisibility(password, togglePassword);
});

togglePassword1.addEventListener("click", function () {
  toggleVisibility(password1, togglePassword1);
});

togglePassword2.addEventListener("click", function () {
  toggleVisibility(password2, togglePassword2);
});
