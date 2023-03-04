// An event listener to the login-form which is activated by the submit button.
function submitFormLogin(event) {
    event.preventDefault();

    // The two variables are filled with the email value and the password from the form
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // if the either email or password aren't filled than an alert message is sent
    if (email === "" || password === "") {
      alert("Please enter both email and password.");
      return;
    }
    console.log(email);
    console.log(password);
    
    // Add header that the value is going to be a value form
    // Reference: https://www.geeksforgeeks.org/http-headers-content-type/
    fetch("https://techytest23.000webhostapp.com/api/authentication.php", {
      method: "POST",
      headers:{
              "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `email=${email}&password=${password}`,
    })
    .then((response)=>response.text())
    .then((data)=>{
      if (data === "Successful") {
        alert("Login successful.");
        window.location.replace("homepage.php");
      } else if (data === "Locked account") {
        alert("This account is locked, please e-mail customer support.");
      } else if (data === "Invalid Password") {
        // Sensitive information disclosure was fixed by alerting user with the following message if any of the credentials is wrong.
        // Security consultant Clayton Farrugia
        alert("Invalid email or password. Please try again.");
        // set pasWordError to true.
      } else{
          alert("Something went wrong please try again later.");
      }
    })
    .catch((error)=> console.error(error));
    
  }
