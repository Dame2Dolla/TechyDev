import React from "react";
import LoginForm from "./component/LoginForm/LoginForm";
import Footer from "./component/NavBar/Footer";
import "./App.scss";
//import Logo from "./component/Logo/Logo";

function App() {
  return (
    <div className="App">
      {/* <Logo /> For now we need to discuss where t put the Logo.*/}
      <h1>Welcome to Student Mind</h1>
      <LoginForm />
      <Footer />
    </div>
  );
}

export default App;
