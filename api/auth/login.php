<?php

require_once '../../config/config.php';
require_once '../../app/core/App.php';
require_once '../../app/core/Database.php';
session_start();

if (isset($_POST['username'])) {
  $db = new Database();
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username = :username";
  $db->query($query);
  $db->bind('username', $username);
  $result = $db->single();

  if ($result == null) {
    $_SESSION['error'] = "Invalid username or password";
    header('location: ../../?login');
  } else {
    if (password_verify($password, $result['password'])) {
      $_SESSION['username'] = $username;
      $_SESSION['is_admin'] = $result['is_admin'] ? 1 : 0;
      header('Location: ../../?home');
    } else {
      $_SESSION['error'] = "Invalid username or password";
      header('location: ../../?login');
    }
  }
}
