//Variables
const customRadioButton = document.getElementById("customRadio");
const notCustomMale = document.getElementById("male");
const notCustomFemale = document.getElementById("female");
const customGenderInput = document.querySelector(".customGenderInput");

// Function to ensure that the input custom gender gets displayed or not.
function showCustomGenderInput() {
    if (customRadioButton.checked) {
      customGenderInput.style.display = "block";
    } else {
      customGenderInput.style.display = "none";
    }
  }
  
  // Call the function to initialize the display state of customGender
  showCustomGenderInput();
  
  // Add event listeners to all the radio buttons to ensure that when other radio button are pressed this js script will be aware.
  customRadioButton.addEventListener("click", showCustomGenderInput);
  notCustomMale.addEventListener("click", showCustomGenderInput);
  notCustomFemale.addEventListener("click", showCustomGenderInput);