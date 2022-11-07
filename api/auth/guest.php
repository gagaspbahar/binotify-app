<?php

if (!isset($_COOKIE['GUEST'])) {
  setcookie('GUEST', '0', time() + 86400, "/");
  setcookie('GUEST_EXPIRE', time() + 86400, time() + 86400, "/");
} else {
  if (time() > $_COOKIE['GUEST_EXPIRE']) {
    setcookie('GUEST', '0', time() + 86400, "/");
    setcookie('GUEST_EXPIRE', time() + 86400, time() + 86400, "/");
  }
}

header('Location: /?home');
