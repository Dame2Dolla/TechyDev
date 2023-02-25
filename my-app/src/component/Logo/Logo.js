import React, { Component } from 'react'
import StudentMindLogo from '../../Images/icon.png'
import "./Logo.scss"

export default class Logo extends Component {
  render() {
    return (
      <>
        <img src={StudentMindLogo} alt="Logo.png" width="160px" height="160px"/>
      </>
    )
  }
}
