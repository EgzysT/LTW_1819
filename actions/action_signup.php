<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  // Only allow letters and numbers in username.
  if (!preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers.');
    die(header('Location: ../pages/signup.php'));
  }

  // Make sure password is not small
  if(strlen($password) < 5) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Password length must have atleast 5 characters.');
    die(header('Location: ../pages/signup.php'));
  }

  try {
    insertUser($username, $password);
    $_SESSION['username'] = $username;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/signup.php');
  } catch (PDOException $e) {
    if ($e->errorInfo[2] == "UNIQUE constraint failed: user.username") { // Duplicate username.
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username already exists.');
    }
    else {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Unknown error.');
    }
    header('Location: ../pages/signup.php');
  }
?>