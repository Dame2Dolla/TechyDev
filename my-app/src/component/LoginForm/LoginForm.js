import React, { useState } from "react";
import "./LoginForm.scss";
import "../../../node_modules/bootstrap/dist/css/bootstrap.min.css";
import SignupForm from "../SignupForm/SignupForm";

const LoginForm = () => {
  //Setting the value of e-mail and password in a used state using props.
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const handleEmailChange = (event) => {
    setEmail(event.target.value);
  };

  const handlePasswordChange = (event) => {
    setPassword(event.target.value);
  };

  const handleLoginSubmit = (event) => {
    //Prevents a reload.
    event.preventDefault();

    // Send a POST request to the PHP API to check if the user exists
    // --> Check the URL when testing.
    fetch("https://techytest23.000webhostapp.com/authentication.php", {
      method: "POST",
      headers: {
        // Type Application: Form Value.
        // Reference: https://www.geeksforgeeks.org/http-headers-content-type/
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `email=${email}&password=${password}`,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "User exists") {
          // If the user exists, redirect to the home page (<--- need to build a home page.)
          //window.location.href = "/home";
          console.log("Correct!");
        } else {
          // If the user does not exist, show an error message
          alert("Invalid email or password");
        }
      })
      .catch((error) => console.error(error));
  };

  return (
    <>
      <div className="login-form">
        <form onSubmit={handleLoginSubmit}>
          <h2 className="text-center">Login</h2>
          <div className="form-group">
            <label>Email:</label>
            <input
              type="email"
              className="form-control"
              value={email}
              onChange={handleEmailChange}
              placeholder="Email@email.com"
            />
          </div>
          <div className="form-group">
            <label>Password:</label>
            <input
              type="password"
              className="form-control"
              value={password}
              onChange={handlePasswordChange}
              placeholder="Abc123?!"
            />
          </div>
          <button type="submit" className="btn btn-primary btn-block">
            Log In
          </button>
          <SignupForm />
        </form>
        <a href="/forgot-password" className="forgot-password">
          Forgot your password?
        </a>
      </div>
    </>
  );
};

export default LoginForm;
