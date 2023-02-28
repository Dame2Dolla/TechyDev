import React, { useState, useRef, useEffect } from "react";
import Overlay from "../Overlay/Overlay";
import "./SignupForm.scss";

const SignupForm = () => {
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [dateOfBirth, setDateOfBirth] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [gender, setGender] = useState("");

  const handleFirstNameChange = (event) => {
    setFirstName(event.target.value);
  };

  const handleLastNameChange = (event) => {
    setLastName(event.target.value);
  };

  const handleDateOfBirthChange = (event) => {
    setDateOfBirth(event.target.value);
  };

  const handleEmailChange = (event) => {
    setEmail(event.target.value);
  };

  const handlePasswordChange = (event) => {
    setPassword(event.target.value);
  };

  const handleGenderChange = (event) => {
    setGender(event.target.value);
  };

  const handleSubmit = (event) => {
    event.preventDefault();

    fetch("http://www.studentmind.xyz/api/signup.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `firstName=${firstName}&lastName=${lastName}&email=${email}&password=${password}&dob=${dateOfBirth}&gender=${gender}`,
    })
      .then((response) => response.text())
      .then((data) => {
        //data isn't being received.
        console.log(data);
        if(data === "Password Incorrect"){
          alert("Password must be longer than 8 characters, must have Uppercase and Lowercase and AlphaNumeric with Special Characters.")
        }
          else if (data === "User Exist") {
          alert("This email is already registered.");
        } else if (data === "User Created") {
          alert("Account is successfully created.");
        } 
      })
      .catch((error) => console.error(error));
  };

  // Toggle the visibility via a useState setting the variable to False.
  const [showForm, setShowForm] = useState(false);
  //useRef is used to hold a reference which is stored in formRef (aka.).
  const formRef = useRef(null);

  // Active function to set the usestate to false if the mouse click happened outside of the Signup Form.
  useEffect(() => {
    function handleClickOutside(event) {
      if (formRef.current && !formRef.current.contains(event.target)) {
        setShowForm(false);
      }
    }

    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, [formRef]);

  const [showOverlay, setShowOverlay] = useState(false);

  const toggleForm = () => {
    setShowForm(!showForm);
    setShowOverlay(!showOverlay);
  };

  return (
    <>
      <div className="signup-form">
        <button onClick={toggleForm} className="btn btn-secondary btn-block">
          Sign up
        </button>
        {showForm && (
          <>
            <Overlay onClick={toggleForm} />
            <div ref={formRef} className="signup-form-official">
              <form onSubmit={handleSubmit}>
                <h2 className="text-center title">Sign Up</h2>
                <div className="form-group">
                  <label>First Name:</label>
                  <input
                    type="text"
                    className="form-control"
                    value={firstName}
                    onChange={handleFirstNameChange}
                  />
                </div>
                <div className="form-group">
                  <label>Last Name:</label>
                  <input
                    type="text"
                    className="form-control"
                    value={lastName}
                    onChange={handleLastNameChange}
                  />
                </div>
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
                    placeholder="Abc123?!"
                  />
                </div>
                <div className="form-group">
                  <label>Date of Birth:</label>
                  <input
                    type="date"
                    className="form-control"
                    value={dateOfBirth}
                    onChange={handleDateOfBirthChange}
                  />
                </div>
                <div className="form-group">
                  <label>Gender:</label>
                  <input
                    type="text"
                    className="form-control"
                    value={gender}
                    onChange={handleGenderChange}
                  />
                </div>
                <div className="form-group">
                  <button type="submit" className="btn btn-primary btn-block">
                    Submit
                  </button>
                </div>
              </form>
            </div>
          </>
        )}
      </div>
    </>
  );
};

export default SignupForm;
