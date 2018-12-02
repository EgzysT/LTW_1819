<?php
  include_once('../includes/session.php');

  if($_SESSION['username'])
    unset($_SESSION['username']);

  header('Location: ../pages/main.php');

?>