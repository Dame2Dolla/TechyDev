const dropdown = document.querySelector(".user-profile-image-header");
const card = document.querySelector(".sub-menu");
const homepageBtn = document.querySelector("#homepage-btn");
let isActive = false;

dropdown.addEventListener("click", () => {
  if (!isActive) {
    isActive = true;
    card.style.display = "block";
  } else {
    isActive = false;
    card.style.display = "none";
  }
});

homepageBtn.addEventListener("click", () => {
  window.location.href = "./userprofile.php";
});

document
  .getElementById("search-input")
  .addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      searchUser();
    }
  });

function searchUser() {
  const search = document.querySelector("#search-input").value;

  fetch("/api/checker/emailchecker.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `email=${search}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "User exists") {
        window.location.href = "useroverview.php?user_data=" + search;
      } else {
        alert("This user doesn't exist.");
      }
    })
    .catch((error) => console.error(error));
}
