import React, { createContext, useContext, useState, useEffect } from "react";

export const CsrfContext = createContext();

export const CsrfProvider = ({ children }) => {
  // useState hook to store CSRF tokens.
  const [csrfToken, setCsrfToken] = useState("");

  useEffect(()=> {
    //Fetch CSRF token from the security_csrf.php
    fetch("https://techytest23.000webhostapp.com/api/securitycsrf.php")
    .then((response) => response.json())
    .then((data)=> setCsrfToken(data.csrfToken))
    .catch((error)=> console.error(error));
  },[])
  console.log(csrfToken);
  return (
    //CSRFContaxt makes the component available for every components.
    <CsrfContext.Provider value={{ csrfToken, setCsrfToken }}>
      {children}
    </CsrfContext.Provider>
  );
};

//Makes the useCsrf function available globally in the javascript side.
export const useCsrf = () => useContext(CsrfContext);
