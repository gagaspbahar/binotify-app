<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> Register to Binotify </title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../../public/css/styles.css" />
    <link rel="stylesheet" href="../../../public/css/register.css" />
    <script src="../../../public/js/register.js"></script>
  </head>

  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">
        You are using an <strong>outdated</strong> browser. Please
        <a href="#">upgrade your browser</a> to improve your experience.
      </p>
    <![endif]-->

    <div class="container">
      <div class="register-container">
        <h1 class="header-title">Binotify</h1>
        <h2 class="header-subtitle">Sign up for free to start listening.</h2>
        <form action="/api/auth/register.php" method="post">
          <div class="form-group">
            <label for="username">Create an username.</label>
            <input
              class="register-input"
              type="text"
              name="username"
              id="username"
              onchange="checkUsername()"
              placeholder="Enter your desired username."
              required
            />
            <p id="username-error"></p>
          </div>
          <div class="form-group">
            <label for="email">What's your email?</label>
            <input
              class="register-input"
              type="email"
              name="email"
              id="email"
              placeholder="Enter your email."
              onchange="checkEmail()"
              required
            />
            <p id="email-error"></p>
          </div>
          <div class="form-group">
            <label for="password">Create a password.</label>
            <input
              class="register-input"
              type="password"
              name="password"
              id="password"
              onchange="checkPassword()"
              placeholder="Create a password."
              required
            />
            <p id="password-error"></p>
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm your password.</label>
            <input
              class="register-input"
              type="password"
              name="confirm-password"
              id="confirm-password"
              onchange="checkPassword()"
              placeholder="Enter your password again."
            />
            <p id="confirm-password-error"></p>
          </div>

          <div class="button-container">
            <button type="submit" class="register-button" id="register-button" disabled>Sign up</button>
          </div>
          
        </form>
        <p class="login">Have an account?
          <span
            class="login-text"
            onclick="window.location.href='/?login'"
          >
            Login
          </span>
        </p>
        <!-- <button class="login-button" onclick="window.location.href='/?login'">
          Log in
        </button> -->
      </div>
    </div>
  </body>
</html>
