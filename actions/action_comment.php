<?php
  /**
   * Adds a comment to a post returning the comment added
   */
  include_once('../includes/session.php');
  include_once('../database/db_story.php');
  include_once('../database/db_user.php');
  include_once('../database/db_channel.php');

  // Verify if user is logged in
  if(!$_SESSION['username'])
    echo('fail');
  else {
    $content = $_POST['content'];
    $parent_post = $_POST['post'];
    
    $username = $_SESSION['username'];

  }

    // check if there is a reference to a user
  preg_match_all('#(?<=\/u\/).+?(?=\/)#', $content, $matches);
 

  foreach ($matches as $match) {
    if ($match) {
      $user = getUserProfile($match[0]);

      if ($user) {
        $search = '#\/u\/' . $match[0] . '\/#';
        $replace =  '<a href="./profile.php?user=' . $match[0] . '" class="author-name">' . $match[0] . '</a>';
        $content = preg_replace($search, $replace, $content);
      }
    }
  }

  // check if there is a reference to a channel
  preg_match_all('#(?<=\/c\/).+?(?=\/)#', $content, $matches);

  foreach ($matches as $match) {
    if ($match) {
      $channel = get_channel_info($match[0]);

      if ($channel) {
        $search = '#\/c\/' . $match[0] . '\/#';
        $replace =  '<a href="./channel.php?name=' . $match[0] . '" class="sc_channel">' . $match[0] . '</a>';
        $content = preg_replace($search, $replace, $content);
      }
    }
  }

    $comment = insertComment($parent_post, $content, $username);

    // turns the values stored in $comment into a string in which the values are separated by |
    $string = implode("|", get_object_vars($comment));
    echo($string);
  
?>