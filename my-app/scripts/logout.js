function logout() {
    fetch("https://techytest23.000webhostapp.com/api/logout.php")
        .then(() => {
            window.location.href = "index.php";
            alert("You've been logged out successfully.")
        })
        .catch((error) => {
            console.error(error);
        });
}