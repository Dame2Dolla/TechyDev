function submitDeletion() {
  fetch("/api/delete.php")
    .then(() => {
      window.location.href = "index.php";
      alert("You're account has been successfully deleted.");
    })
    .catch((error) => {
      console.error(error);
    });
}
