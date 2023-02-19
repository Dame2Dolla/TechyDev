import React, { useState, useRef, useEffect } from "react";
import "./SignupForm.scss";

const SignupForm = () => {
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [dateOfBirth, setDateOfBirth] = useState("");
  const [address, setAddress] = useState("");
  const [street, setStreet] = useState("");
  const [country, setCountry] = useState("");
  const [phoneNumber, setPhoneNumber] = useState("");
  const [gender, setGender] = useState("");
  const [description, setDescription] = useState("");

  const handleFirstNameChange = (event) => {
    setFirstName(event.target.value);
  };

  const handleLastNameChange = (event) => {
    setLastName(event.target.value);
  };

  const handleDateOfBirthChange = (event) => {
    setDateOfBirth(event.target.value);
  };

  const handleAddressChange = (event) => {
    setAddress(event.target.value);
  };

  const handleStreetChange = (event) => {
    setStreet(event.target.value);
  };

  const handleCountryChange = (event) => {
    setCountry(event.target.value);
  };

  const handlePhoneNumberChange = (event) => {
    setPhoneNumber(event.target.value);
  };

  const handleGenderChange = (event) => {
    setGender(event.target.value);
  };

  const handleDescriptionChange = (event) => {
    setDescription(event.target.value);
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    // TODO: Add another API connection to INSERT the data to the database. This will be fun...
  };

  // Toggle the visibility via a useState setting the variable to False.
  const [showForm, setShowForm] = useState(false);
  //useRef is used to hold a reference which is stored in formRef.
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

  const toggleForm = () => {
    setShowForm(!showForm);
  };

  return (
    <div className="signup-form">
      <button onClick={toggleForm} className="btn btn-secondary btn-block">Sign up</button>
      {showForm && (
        <div ref={formRef}>
          <form onSubmit={handleSubmit}>
            <h2 className="text-center">Sign Up</h2>
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
              <label>Date of Birth:</label>
              <input
                type="date"
                className="form-control"
                value={dateOfBirth}
                onChange={handleDateOfBirthChange}
              />
            </div>
            <div className="form-group">
              <label>Address:</label>
              <input
                type="text"
                className="form-control"
                value={address}
                onChange={handleAddressChange}
              />
            </div>
            <div className="form-group">
              <label>Street:</label>
              <input
                type="text"
                className="form-control"
                value={street}
                onChange={handleStreetChange}
              />
            </div>
            <div className="form-group">
              <label>Country:</label>
              <input
                type="text"
                className="form-control"
                value={country}
                onChange={handleCountryChange}
              />
            </div>
            <div className="form-group">
              <label>Phone Number:</label>
              <input
                type="tel"
                className="form-control"
                value={phoneNumber}
                onChange={handlePhoneNumberChange}
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
              <label>Describe yourself (Optional):</label>
              <textarea
                className="form-control"
                value={description}
                onChange={handleDescriptionChange}
              />
            </div>
            <div className="form-group">
              <button type="submit" className="btn btn-primary btn-block">
                Sign Up
              </button>
            </div>
          </form>
        </div>
      )}
    </div>
  );
};

export default SignupForm;
