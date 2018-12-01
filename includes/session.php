<?php
  session_start();

  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }

  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }

  if(!isset($_SESSION['username']))
    $_SESSION['username'] = $username = NULL;
?>