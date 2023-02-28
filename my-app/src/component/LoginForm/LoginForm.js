import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import "./LoginForm.scss";
import "../../../node_modules/bootstrap/dist/css/bootstrap.min.css";
import SignupForm from "../SignupForm/SignupForm";
import Cookies from "js-cookie";
import ForgotPassword from "../ForgotPassword/ForgotPassword";
import Footer from "../Footer/Footer";

const LoginForm = () => {
  //Setting the value of e-mail and password in a used state using props.
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  //First time signing in the initial state of the checkbox will be off.
  const [rememberMe, setRememberMe] = useState(false);
  //Implementation of show or hide password.
  const [showPassword, setShowPassword] = useState(false);
  //Use navigate hook to direct to the new site.
  const navigate = useNavigate();

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
    fetch("http://www.studentmind.xyz/api/authentication.php", {
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
          navigate("/homepage");
        } else if (data === "Locked account") {
          alert("This account is locked, please e-mail customer support.");
        } else if (data === "Invalid Password") {
          // Sensitive information disclosure was fixed by alerting user with the following message if any of the credentials is wrong.
          // Security consultant Clayton Farrugia
          alert("Invalid email or password. Please try again.");
        } else if (data === "Invalid") {
          alert("Please, fill your login information.");
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
              title="Enter your e-mail"
            />
          </div>
          <div className="form-group">
            <label>Password:</label>
            <input
              type={showPassword ? "text" : "password"}
              className="form-control"
              value={password}
              onChange={handlePasswordChange}
              placeholder="Abc123?!"
            />
            <>
              <button
                className="btn password-icon"
                type="button"
                onClick={() => setShowPassword(!showPassword)}
              >
                {showPassword ? (
                  <FontAwesomeIcon icon={faEyeSlash}/>
                ) : (
                  <FontAwesomeIcon icon={faEye}/>
                )}
              </button>
            </>
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
      <Footer />
    </>
  );
};

export default LoginForm;
