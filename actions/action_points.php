<?php
  /**
   * Handles upvoting/downvoting of comments and stories.
   */
  include_once('../includes/session.php');
  include_once('../database/db_post.php');

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
    upvote($username, $post);
  } else if ($action === 'downvote') {
    downvote($username, $post);
  } else if ($action === 'clear_vote') {
    clear_vote($username, $post);
  } else {
    die('Invalid Action');
  }

?>