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

  const ongoingCheckbox = document.getElementById("ongoing");
  const endDateInput = document.getElementById("endDate");

  // Disable the End date input if the Ongoing checkbox is checked
  ongoingCheckbox.addEventListener("change", function () {
    endDateInput.disabled = this.checked;
  });

  // Get the checkbox and endDate input field elements
  const ongoingCheckboxEdit = document.getElementById("ongoingEdit");
  const endDateInputEdit = document.getElementById("endDateEdit");

  // Lock or unlock the endDate input field based on the ongoing state
  endDateInputEdit.disabled = ongoing;

  // Add an event listener to the checkbox
  ongoingCheckboxEdit.addEventListener("change", function () {
    // Lock or unlock the endDate input field based on the checkbox's state
    endDateInputEdit.disabled = this.checked;
  });

  const AddUniversityForm = document.getElementById("new-university-form");
  AddUniversityForm.addEventListener("submit", submitAddUniversity);

  const EditUniversityForm = document.getElementById("edit-university-form");
  EditUniversityForm.addEventListener("submit", submitEditUniversity);

  const AddProjectForm = document.getElementById("new-project-form");
  AddProjectForm.addEventListener("submit", submitAddProject);

  const EditProjectForm = document.getElementById("edit-project-form");
  EditProjectForm.addEventListener("submit", submitEditProject);
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
      } else {
        alert("Something went wrong please try again later.");
      }
    })
    .catch((error) => console.error(error));
}

//Delete profile.
function submitDeletion(event) {
  event.preventDefault();
  fetch("/api/userdetailsApi/delete.php")
    .then((response) => response.text())
    .then((data) => {
      if (data === "Complete") {
        alert("Account has been deleted.");
        window.location.href = "./index.php";
      } else {
        alert("Something has gone wrong. Please try again later.");
      }
    })
    .catch((error) => console.error(error));
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
    alert("Passwords do not match. Please check the spelling and try again.");
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
              if (data === "password changed") {
                alert("Password has been changed");
                window.location.reload();
              } else if (data === "invalid input") {
                alert(
                  "Password must be longer than 15 characters, must have Uppercase and Lowercase and AlphaNumeric with Special Characters."
                );
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

function submitAddUniversity(event) {
  event.preventDefault();

  const university = document.getElementById("university").value;
  const certificate = document.getElementById("certificate").value;
  const startdate = document.getElementById("startDate").value;
  const enddate = document.getElementById("endDate").value;
  const ongoing = document.getElementById("ongoing");

  // Get the checked state of the checkbox
  const isOngoing = ongoing.checked;

  // Validate date range
  if (!ongoing && new Date(startdate) > new Date(enddate)) {
    alert(
      "End date cannot be before the start date, and start date cannot be after the end date. Please correct the dates and try again."
    );
    return;
  }

  // Validate end date is not in the future
  const today = new Date();
  today.setHours(0, 0, 0, 0); // Set time to midnight for accurate date comparison
  if (!ongoing && new Date(enddate) > today) {
    alert("End date cannot be in the future.");
    return;
  }

  fetch("/api/userdetailsApi/adduniversity.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `university=${university}&certificate=${certificate}&startdate=${startdate}&enddate=${enddate}&ongoing=${isOngoing}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Complete") {
        alert("University has been added successfully.");
        window.location.reload();
      } else if (data === "Already registered") {
        alert(
          "This University and Certificate is already registered into your account. Please change the already existing information."
        );
      } else {
        alert("Something has gone wrong. Please try again later.");
      }
    })
    .catch((error) => console.error(error));
}

function submitEditUniversity(event) {
  event.preventDefault();

  const educationId = document.getElementById("educationId").value;
  const universityEdit = document.getElementById("universityEdit").value;
  const certificateEdit = document.getElementById("certificateEdit").value;
  const startDateEdit = document.getElementById("startDateEdit").value;
  const endDateEdit = document.getElementById("endDateEdit").value;
  const ongoingEdit = document.getElementById("ongoingEdit");

  // Get the checked state of the checkbox
  const isOngoingEdit = ongoingEdit.checked;

  // Validate date range
  if (!ongoingEdit && new Date(startDateEdit) > new Date(endDateEdit)) {
    alert(
      "End date cannot be before the start date, and start date cannot be after the end date. Please correct the dates and try again."
    );
    return;
  }

  // Validate end date is not in the future
  const today = new Date();
  today.setHours(0, 0, 0, 0); // Set time to midnight for accurate date comparison
  if (!ongoingEdit && new Date(endDateEdit) > today) {
    alert("End date cannot be in the future.");
    return;
  }

  fetch("/api/userdetailsApi/edituniversity.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `educationID=${educationId}&universityEdit=${universityEdit}&certificateEdit=${certificateEdit}&startDateEdit=${startDateEdit}&endDateEdit=${endDateEdit}&ongoingEdit=${isOngoingEdit}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Complete") {
        alert("University has been changed successfully.");
        window.location.reload();
      } else {
        alert("Something has gone wrong. Please try again later.");
      }
    })
    .catch((error) => console.error(error));
}

function submitAddProject(event) {
  event.preventDefault();

  const projectName = document.getElementById("addProjectName").value;
  const projectDesc = document.getElementById("addProjectDesc").value;
  const ongoing = document.getElementById("addProjectIsOngoing");

  // Get the checked state of the checkbox
  const isOngoing = ongoing.checked;

  fetch("/api/userdetailsApi/addproject.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `projectName=${projectName}&projectDesc=${projectDesc}&ongoing=${isOngoing}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Complete") {
        alert("Project has been added successfully.");
        window.location.reload();
      } else {
        alert("Something has gone wrong. Please try again later.");
      }
    })
    .catch((error) => console.error(error));
}

function submitEditProject(event) {
  event.preventDefault();

  const projectId = document.getElementById("projectId").value;
  const projectNameEdit = document.getElementById("projectNameEdit").value;
  const projectDescEdit = document.getElementById("projectDescEdit").value;
  const projectOngoingEdit = document.getElementById("projectOngoingEdit");

  // Get the checked state of the checkbox
  const isOngoingEdit = projectOngoingEdit.checked;

  fetch("/api/userdetailsApi/editproject.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `projectId=${projectId}&projectNameEdit=${projectNameEdit}&projectDescEdit=${projectDescEdit}&projectOngoingEdit=${isOngoingEdit}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Complete") {
        alert("Project has been changed successfully.");
        window.location.reload();
      } else {
        alert("Something has gone wrong. Please try again later.");
      }
    })
    .catch((error) => console.error(error));
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

function openEducationEditPopup(
  educationId,
  institutionName,
  courseTitle,
  startDate,
  endDate,
  isOngoing
) {
  document.getElementById("educationId").value = educationId;
  document.getElementById("universityEdit").value = institutionName;
  document.getElementById("certificateEdit").value = courseTitle;
  document.getElementById("startDateEdit").value = startDate;
  document.getElementById("endDateEdit").value = endDate;
  document.getElementById("ongoingEdit").checked = isOngoing;

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
function openEditProjectPopup(
  projectId,
  projectName,
  projectDesc,
  projectIsOngoing
) {
  document.getElementById("projectId").value = projectId;
  document.getElementById("projectNameEdit").value = projectName;
  document.getElementById("projectDescEdit").value = projectDesc;
  document.getElementById("projectOngoingEdit").checked = projectIsOngoing;
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
