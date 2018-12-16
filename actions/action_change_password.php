<?php
  /**
   * Checks if the password is correct, and if so, changes to the new email
   */
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  if(!$_SESSION['username'])
		die('fail');
	if($_SESSION['csrf'] !== $_POST['csrf'])
		die('Invalid csrf');
		
	$username = $_SESSION['username'];
	$password = $_POST['currPassword'];
	$newPassword1 = $_POST['newPassword1'];
	$newPassword2 = $_POST['newPassword2'];
	if ($newPassword1 !== $newPassword2 ) {
		die('Passwords don\'t match.');
	}

	if (checkUserPassword($username, $password)) {
		updateUserPassword($username, $newPassword1);
		echo 'ok';
	}
	else
		die('Wrong current password.');

?>