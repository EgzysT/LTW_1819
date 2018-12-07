<?php
  /**
   * Adds a comment to a post returning the comment added
   */
  include_once('../includes/session.php');
  include_once('../database/db_story.php');
  include_once('../database/db_user.php');

  // Verify if user is logged in
  if(!$_SESSION['username'])
    echo('fail');
  else {
    $content = $_POST['content'];
    $parent_post = $_POST['post'];
    
    $username = $_SESSION['username'];

    $profile = getUserProfile($username);
    $user_id = $profile->id;

    $comment = insertComment($parent_post, $content, $user_id);

    // turns the values stored in $comment into a string in which the values are separated by |
    $string = implode("|", get_object_vars($comment));
    echo($string);
  }
?>