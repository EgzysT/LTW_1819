<?php
  /**
   * Checks if the log in credentials exists, setting messages in case they're not valid
   */
  include_once('../includes/session.php');
  include_once('../database/db_story.php');
  include_once('../database/db_user.php');

  // Verify if user is logged in
  if(!$_SESSION['username'])
  die(header('Location: ../pages/main.php'));

  $content = $_POST['content'];
  $parent_post = $_POST['post'];
  
  $username = $_SESSION['username'];

  $profile = getUserProfile($username);
  $user_id = $profile->id;

  $comment_id = insertComment($parent_post, $content, $user_id);
  $comments = getComments($parent_post);
?>