<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Only allow letters and numbers in username.
  if (!preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
    echo 'Username must only contain letters and digits.';
    return;
  }

  // Make sure password is not small
  if(strlen($password) < 5) {
    echo 'Password length must be greater than 4 characters.';
    return;
  }

  // Make sure the user entered the same input on the password and confirm password field.
  if($password !== $confirm_password) {
    echo 'Passwords don\'t match.';
    return;
  }

  try {
    insertUser($username, $email, $password);
    $_SESSION['username'] = $username;
    echo 'ok';
  } catch (PDOException $e) {
    if ($e->errorInfo[2] == "UNIQUE constraint failed: user.username") { // Duplicate username.
      echo 'Username already exists.';
    }
    else if ($e->errorInfo[2] == "UNIQUE constraint failed: user.email") { // Duplicate email.
      echo 'Email already exists.';
    }
    else {
      echo 'Unknown error.';
    }
  }
?>