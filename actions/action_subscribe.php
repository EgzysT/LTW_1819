<?php
  /**
   * Checks if the log in credentials exists, setting messages in case they're not valid
   */
  include_once('../includes/session.php');
  include_once('../database/db_channel.php');

  $username = $_SESSION['username'];
  if(!$username)
    exit(0);

  $action = $_POST['action'];
  $channel_name = $_POST['channel_name'];

  //Validate action.
  if($action !== 'subscribe' && $action !== 'unsubscribe')
    die('Invalid action.');

  // Validate csrf
  if($_SESSION['csrf'] !== $_POST['csrf'])
    die('Invalid csrf');

  if($action === 'subscribe') {
    subscribe($username, $channel_name);
  } else if ($action === 'unsubscribe') {
    unsubscribe($username, $channel_name);
  }

?>