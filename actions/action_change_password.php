<?php
  /**
   * Checks if the password is correct, and if so, changes to the new email
   */
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  if(!$_SESSION['username'])
    echo('fail');
  else {
		$username = $_SESSION['username'];
		$password = $_POST['currPassword'];
		$newPassword1 = $_POST['newPassword1'];
		$newPassword2 = $_POST['newPassword2'];
		if ($newPassword1 == $newPassword2 && checkUserPassword($username, $password)) {
			updateUserPassword($username, $newPassword1);
			echo 'ok';
		}
		else {
			echo 'fail';
		}
		die(header('Location: ../pages/edit_profile.php'));
  }

?>