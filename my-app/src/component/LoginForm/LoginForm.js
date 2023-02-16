import React, { useState } from "react";
import "./LoginForm.scss";

const LoginForm = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const handleEmailChange = (event) => {
    setEmail(event.target.value);
  };

  const handlePasswordChange = (event) => {
    setPassword(event.target.value);
  };

  const handleLoginSubmit = (event) => {
    event.preventDefault();
    // TODO: Add login logic here
    //open database and search for matching credentials
  };

  const handleSignupSubmit = (event) => {
    event.preventDefault();
    // TODO: Add signup logic here 
      //Load Sign up page
  };

  return (
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
          />
        </div>
        <div className="form-group">
          <label>Password:</label>
          <input
            type="password"
            className="form-control"
            value={password}
            onChange={handlePasswordChange}
          />
        </div>
        <button type="submit" className="btn btn-primary btn-block">
          Log In
        </button>
        <button
          onClick={handleSignupSubmit}
          className="btn btn-secondary btn-block"
        >
          Sign Up
        </button>
      </form>
      <a href="/forgot-password" className="forgot-password">
        Forgot your password?
      </a>
    </div>
  );
};

export default LoginForm;
