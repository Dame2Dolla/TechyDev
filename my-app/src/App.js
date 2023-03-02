import React, { useState } from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import HomePage from "./component/Pages/HomePage/HomePage";
import LoginPage from "./component/Pages/LoginPage/LoginPage";
import { CsrfContext } from "./component/Security/csrfcontext";

function App() {
  const [csrfToken, setCsrfToken] = useState("");
  return (
    <CsrfContext.Provider value={{ csrfToken, setCsrfToken }}>
      <BrowserRouter>
        <Routes>
          <Route exact path="/" element={<LoginPage />} />
          <Route path="/homepage" element={<HomePage />} />
        </Routes>
      </BrowserRouter>
    </CsrfContext.Provider>
  );
}

export default App;
