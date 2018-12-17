<?php
  /**
   * Checks if the password is correct, and if so, changes to new password
   */
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  if(!$_SESSION['username'])
		die('Log in first.');
		
	// Validate csrf
	if($_SESSION['csrf'] !== $_POST['csrf'])
		die('Invalid csrf');

  else {
		$username = $_SESSION['username'];
		$password = $_POST['password'];
		$newEmail = $_POST['newEmail'];
		if (checkUserPassword($username, $password)) {
			updateUserEmail($username, $newEmail);
			die('ok');
		}
		else {
			die('Invalid current password');
		}
  }

?>