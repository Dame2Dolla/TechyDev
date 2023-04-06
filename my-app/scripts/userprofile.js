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
  overlay.style.display = "none";
  popup.style.display = "none";
  popup_personal.style = "none";
  popup_email.style = "none";
  overlay.style.zIndex = "5";
  popup_password.style = "none";
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
