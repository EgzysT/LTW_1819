<?php
  /**
   * Checks if the log in credentials exists, setting messages in case they're not valid
   */
  include_once('../includes/session.php');

  // Verify if user is logged in
  if(!$_SESSION['username'])
    echo('fail');
  else {
    echo('ok');
  }
?>