import React, { Component } from 'react'
import LoginForm from '../../LoginForm/LoginForm'
import "./LoginPage.scss"

export default class LoginPage extends Component {
  render() {
    return (
      <div className='Login-Form'>
      <h1>Welcome to Student Mind</h1>
        <LoginForm/>
      </div>
    )
  }
}
