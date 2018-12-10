<?php
  /**
   * Checks if the log in credentials exists, setting messages in case they're not valid
   */
  include_once('../includes/session.php');
  include_once('../database/db_story.php');
  include_once('../database/db_channel.php');

  $username = $_SESSION['username'];
  if(!$username)
    exit(0);

  // Validate csrf
  if($_SESSION['csrf'] !== $_POST['csrf'])
    die('Invalid csrf');
    
  $channel_name = $_POST['channel_name'];
  $story_title = $_POST['story_title'];
  $story_text = $_POST['story_text'];

  if(strlen($story_title) < 10)
    die('Story title is too short.');
  if(strlen($story_title) > 100)
      die('Story title is too long.');

  if(strlen($story_text) < 70)
    die('Story title is too short.');
  if(strlen($story_title) > 2500)
    die('Story title is too long.');

  if(!get_channel_info($channel_name)) 
    die('Channel doesn\'t exist.');

  createStory($channel_name, $username, $story_title, $story_text);

  die('ok');

?>