const dropdown = document.querySelector(".user-menu-button");
const dropdownActive = "./images/dropdownmenuActive.svg";
const dropdownInactive = "./images/dropdownmenu.svg";

const card = document.querySelector(".sub-menu");

const homepageBtn = document.querySelector("#homepage-btn");

let isActive = false;

dropdown.addEventListener("click", () => {
  if (!isActive) {
    dropdown.src = dropdownActive;
    isActive = true;
    card.style.display = "block";
  } else {
    dropdown.src = dropdownInactive;
    isActive = false;
    card.style.display = "none";
  }
});

homepageBtn.addEventListener("click", () => {
  window.location.href = "./userprofile.php";
});
