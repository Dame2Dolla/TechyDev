function submitPrimaryDetailsChange(event) {
  event.preventDefault();
  // The two variables are filled with the email value and the password from the form
  const firstName = document.getElementById("firstName").value;
  const lastName = document.getElementById("lastName").value;
  // token to be used for security purposes
  const token = document.getElementById("token").value;

  fetch("/api/changedetails.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `firstName=${firstName}&lastName=${lastName}&token=${token}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "Successful") {
        alert("Details have been changed successfully.");
        // Once user clicks on alert. the page refreshes.
        location.reload();
      } else if (data === "bad token") {
        alert("Please refresh the page and try again.");
      } else {
        alert("Something went wrong. Please try again later.");
      }
    })
    .catch((error) => console.error(error));
}
