import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import HomePage from "./component/Pages/HomePage/HomePage";
import LoginPage from "./component/Pages/LoginPage/LoginPage";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route exact path="/" element={<LoginPage />} />
        <Route path="/homepage" element={<HomePage />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
