import React, { useState, useEffect } from "react";
import "./LoginForm.scss";
import "../../../node_modules/bootstrap/dist/css/bootstrap.min.css";
import SignupForm from "../SignupForm/SignupForm";
import Cookies from "js-cookie";
import ForgotPassword from "../ForgotPassword/ForgotPassword";

const LoginForm = () => {
  //Setting the value of e-mail and password in a used state using props.
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  //First time signing in the initial state of the checkbox will be off.
  const [rememberMe, setRememberMe] = useState(false);

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
          //If statement to check if the initial value of the cookie is ticked and will remain in storage for 7 days. If not the cookie is removed.
          if (rememberMe) {
            Cookies.set("email", email, { expires: 7 });
          } else {
            Cookies.remove("email");
          }
          // If the user exists, redirect to the home page (<--- need to build a home page.)
          //window.location.href = "/home";
          console.log("Correct!");
        } else if(data === "Invalid Password"){
          alert("Invalid password!")
        }
        else if(data === "Invalid Email"){
          alert("Invalid email!");
        }
      })
      .catch((error) => console.error(error));
  };
  //UseEffect is used to pre fill the checkbox if the cookie aleary exists. This is done PreLoad.
  useEffect(() => {
    const emailFromCookie = Cookies.get("email");
    if (emailFromCookie) {
      setEmail(emailFromCookie);
      setRememberMe(true);
    }
  }, []);

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
          <div className="form-group form-check">
            <input
              type="checkbox"
              className="form-check-input"
              id="remember-me-checkbox"
              checked={rememberMe}
              onChange={(e) => setRememberMe(e.target.checked)}
            />
            <label className="form-check-label" htmlFor="remember-me-checkbox">
              Remember me
            </label>
          </div>
          <button type="submit" className="btn btn-primary btn-block">
            Log In
          </button>
        </form>
        <SignupForm />
     
          <ForgotPassword />
        
      </div>
    </>
  );
};

export default LoginForm;
