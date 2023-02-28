import React, { useState } from "react";
import "./ForgotPassword.scss";
import Overlay from "../Overlay/Overlay";

const PasswordResetCard = () => {
  const [email, setEmail] = useState("");
  const [message, setMessage] = useState("");
  const [showCard, setShowCard] = useState(false);

  const handleEmailChange = (event) => {
    setEmail(event.target.value);
  };

  const handlePasswordReset = (event) => {
    event.preventDefault();

    // Send a POST request to the PHP API to check if the user exists
    fetch("http://www.studentmind.xyz/api/usernamechecker.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `email=${email}`,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "User exists") {
          // If the user exists, send an email to the user's email address
          fetch("http://www.studentmind.xyz/api/sendemailtouser.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `email=${email}`,
          })
            .then((response) => response.text())
            .then((data) => {
              setMessage(data);
            })
            .catch((error) => console.error(error));
        } else {
          // If the user does not exist, show a warning message
          setMessage("User does not exist.");
        }
      })
      .catch((error) => console.error(error));
  };

  const toggleCard = (event) => {
    event.preventDefault();
    setShowCard(!showCard);
  };

  const handleOverlayClick = () => {
    setShowCard(false);
  };

  return (
    <>
      <a href="/" className="forgot-password" onClick={toggleCard} >
        Forgot your password?
      </a>
      {showCard && (
        <>
          <Overlay onClick={handleOverlayClick} />
          <div className="card password-reset-card">
            <div className="card-body">
              <h2 className="card-title">Forgot your password?</h2>
              <form onSubmit={handlePasswordReset}>
                <div className="form-group">
                  <label htmlFor="email">Enter your email address:</label>
                  <input
                    type="email"
                    className="form-control"
                    id="email"
                    value={email}
                    onChange={handleEmailChange}
                  />
                </div>
                <button type="submit" className="btn btn-primary btn-block">
                  Confirm
                </button>
                <div className="message">{message}</div>
              </form>
            </div>
          </div>
        </>
      )}
    </>
  );
};

export default PasswordResetCard;
