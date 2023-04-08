function openAboutPopup() {
  const overlay = document.getElementById("overlay");
  const popup = document.getElementById("popup-about");
  overlay.style.display = "block";
  popup.style.display = "block";
  document.body.classList.add("no-scroll");
}

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

function toggleVisibility(inputElement, eyeElement) {
  if (inputElement.type === "password") {
    inputElement.type = "text";
    eyeElement.src = "./images/eye-slash.svg";
  } else {
    inputElement.type = "password";
    eyeElement.src = "./images/eye.svg";
  }
}

togglePassword.addEventListener("click", function () {
  toggleVisibility(password, togglePassword);
});

togglePassword1.addEventListener("click", function () {
  toggleVisibility(password1, togglePassword1);
});

togglePassword2.addEventListener("click", function () {
  toggleVisibility(password2, togglePassword2);
});
