document
  .getElementById("forgot-password-button")
  .addEventListener("click", function () {
    $("#forgot-password-modal").modal("show");
  });

function submitFormForgotPassword(event) {
  event.preventDefault();

  // Get the email input value
  const email = document.getElementById("forgot-password-email").value;

  // Send a POST request to the PHP API to check if the user exists
  fetch("https://techytest23.000webhostapp.com/api/usernamechecker.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `email=${email}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "User exists") {
        // If the user exists, send an email to the user's email address
        fetch("https://techytest23.000webhostapp.com/api/sendemailtouser.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `email=${email}`,
        })
          .then((response) => response.text())
          .then((data) => {
            document.getElementById("message").textContent = data;
          })
          .catch((error) => console.error(error));
      } else {
        // If the user does not exist, show a warning message
        document.getElementById("message").textContent = "User does not exist.";
      }
    })
    .catch((error) => console.error(error));
}
