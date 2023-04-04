// Get elements
const editButton = document.querySelector(".edit-button");
const closeButton = document.getElementById("close-button");
const modalOverlay = document.getElementById("modal-overlay");
const modal = document.getElementById("modal");

// Toggle modal visibility
function toggleModal() {
  modalOverlay.style.display =
    modalOverlay.style.display === "block" ? "none" : "block";
  modal.style.display = modal.style.display === "block" ? "none" : "block";
}

// Add event listeners
editButton.addEventListener("click", toggleModal);
closeButton.addEventListener("click", toggleModal);
modalOverlay.addEventListener("click", toggleModal);
