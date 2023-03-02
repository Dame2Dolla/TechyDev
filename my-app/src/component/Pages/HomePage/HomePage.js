import React, { Component } from "react";

export default class HomePage extends Component {
  render() {

    const handleLogout =(event) =>
    {
      event.preventDefault();
      fetch("https://techytest23.000webhostapp.com/api/logout.php" ,{
        headers : {
          "Content-Type": "application/x-www-form-urlencoded",
        }
      })
      .then((response) => response.text())
      .then((data)=> {
        console.log(data);
    }).catch((error) => console.error(error));
    }

    return (
      <>
        <h1>Welcome to the HomePage</h1>
        <button className="btn btn-primary btn-lg" onClick={handleLogout}>Logout</button>
      </>
    );
  }
}
