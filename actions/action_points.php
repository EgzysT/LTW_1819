<?php
  /**
   * Handles upvoting/downvoting of comments and stories.
   */
  include_once('../includes/session.php');
  include_once('../database/db_channel.php');

  $username = $_SESSION['username'];
  if(!$username)
    exit(0);

  $action = $_POST['action'];
  $post = $_POST['post'];

  // Validate csrf
  if($_SESSION['csrf'] !== $_POST['csrf'])
    die('Invalid csrf');

  //Handle action.
  if($action === 'upvote') {
    echo 'upvote';
  } else if($action === 'downvote') { 
    echo 'downvote';
  } else {
    die(0);
  }

?>