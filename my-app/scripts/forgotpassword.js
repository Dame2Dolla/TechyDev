const popup = document.getElementById("popup");

// overlay style list display changes to block.
// popup adds the css list into the popup from open-popup
function openPopup() {
  overlay.style.display = "block";
  popup.classList.add("open-popup");
}

// overlay style list display changes to none.
// popup removes the css list into the popup from open-popup.
function closePopup() {
  overlay.style.display = "none";
  popup.classList.remove("open-popup");
}

function submitFormForgotPassword(event) {
  event.preventDefault();

  // Get the email input value
  const email = document.getElementById("forgot-password-email").value;

  // Send a POST request to the PHP API to check if the user exists
  fetch("/api/checker/emailchecker.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      email: email,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "User exists") {
        // If the user exists, send an email to the user's email address
        fetch("/api/sendemailtouser.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: email,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status === "Email sent") {
              alert("Email sent.");
              closePopup();
            } else if (data.status === "Failed") {
              alert(
                "Email failed to generate. please contact customer support."
              );
            } else {
              alert("Something went wrong please try again later.");
            }
          })
          .catch((error) => console.error(error));
      } else {
        // If the user does not exist, show a warning message
        alert("User does not exist.");
      }
    })
    .catch((error) => console.error(error));
}
