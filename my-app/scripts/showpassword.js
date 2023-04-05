var passwordInput = document.getElementById("password");
var passwordIcon = document.querySelector(".password-icon i");

passwordIcon.addEventListener("click", function () {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordIcon.classList.remove("fa-eye");
    passwordIcon.classList.add("fa-eye-slash");
  } else {
    passwordInput.type = "password";
    passwordIcon.classList.remove("fa-eye-slash");
    passwordIcon.classList.add("fa-eye");
  }
});

// Modal popup for login password change.

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

togglePassword1.addEventListener("click", function () {
  toggleVisibility(password1, togglePassword1);
});

togglePassword2.addEventListener("click", function () {
  toggleVisibility(password2, togglePassword2);
});
