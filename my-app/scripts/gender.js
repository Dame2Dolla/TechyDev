// Show/hide custom gender text area based on "custom" drop down selection

// Variables
const customGenderInput = document.querySelector(".customGenderInput");

// Function to ensure that the input custom gender gets displayed or not.
document.getElementById("gender").addEventListener("change", function () {
  const customGender = document.getElementById("customGender");
  if (this.value === "other") {
    customGender.disabled = false;
  } else {
    customGender.disabled = true;
    customGender.value = "";
  }
});

// Call the function to initialize the display state of customGender
showCustomGenderInput();

// Add an event listener to the dropdown list to ensure that the custom gender input field is enabled or disabled based on the selected option.
function showCustomGenderInput() {
  const genderSelect = document.getElementById("gender");
  const customGender = document.getElementById("customGender");

  if (genderSelect.value === "other") {
    customGender.disabled = false;
  } else {
    customGender.disabled = true;
    customGender.value = "";
  }
}
