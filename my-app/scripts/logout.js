function logout() {
  fetch("/api/logout.php")
    .then(() => {
      window.location.href = "index.php";
      alert("You've been logged out successfully.");
    })
    .catch((error) => {
      console.error(error);
    });
}
