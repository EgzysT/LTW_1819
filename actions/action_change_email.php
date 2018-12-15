<?php
  /**
   * Checks if the password is correct, and if so, changes to new password
   */
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  if(!$_SESSION['username'])
    echo('fail');
  else {
		$username = $_SESSION['username'];
		$password = $_POST['password'];
		$newEmail = $_POST['newEmail'];
		if (checkUserPassword($username, $password)) {
			updateUserEmail($username, $newEmail);
			echo 'ok';
		}
		else {
			echo 'fail';
		}
		die(header('Location: ../pages/edit_profile.php'));
  }

?>