<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login to Binotify</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../../public/css/styles.css" />
    <link rel="stylesheet" href="../../../public/css/login.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="/>
  </head>

  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">
        You are using an <strong>outdated</strong> browser. Please
        <a href="#">upgrade your browser</a> to improve your experience.
      </p>
    <![endif]-->

    <div class="container">
      <div class="login-container">
        <img src="../../../public/img/binotify-mascot.svg" alt="logo" class="logo">
        <h1 class="header-title">Binotify</h1>
        <p class="header-subtitle">To continue, login to Binotify.</p>

        <form action="/api/auth/login.php" method="post">
          <div class="username-form">
            <label for="username">Username</label>
            <input
              class="login-input"
              type="text"
              name="username"
              id="username"
              placeholder="Enter your username"
              required
            /><br />
          </div>
          <div class="username-form">
            <label for="password">Password</label>
            <input
              class="login-input"
              type="password"
              name="password"
              id="password"
              placeholder="Enter your password"
              required
            />
          </div>
          <br />
          <button class="login-button" type="submit">Login</button>
        </form>
        <p class="login-error">
          <?php
                              if (isset($_SESSION['error'])) {
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                              }
                              ?>
        </p>
        <p class="signup">Don't have an account?
          <span onclick="window.location.href='/?register'"
            class="signup-text"
          >
            Sign Up
          </span>
        </p>

        <!-- <button
          class="signup-button"
          onclick="window.location.href='/?register'"
        >
          Sign Up
        </button> -->
        <!-- <p class="signup">OR</p> -->

        <div class="line"></div>
        <button
          class="guest-button"
          onclick="window.location.href='/api/auth/guest.php'"
        >
           Login as Guest
        </button>
      </div>
    </div>
  </body>
</html>
