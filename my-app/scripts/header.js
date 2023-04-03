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
      this.form.submit();
    }
  });
