import React from "react";
import "./Overlay.scss";

const Overlay = (props) => {
  return <div className="overlay" onClick={props.onClick}></div>;
};

export default Overlay;
