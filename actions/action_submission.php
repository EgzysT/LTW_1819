<?php
  /**
   * Checks if the log in credentials exists, setting messages in case they're not valid
   */
  include_once('../includes/session.php');
  include_once('../includes/Parsedown.php');
  include_once('../database/db_story.php');
  include_once('../database/db_channel.php');
  include_once('../database/db_user.php');


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
    die('Story content is too short.');
  if(strlen($story_text) > 5000)
    die('Story content is too long.');

  if(!get_channel_info($channel_name)) 
    die('Channel doesn\'t exist.');

  // Escape storytext.
  $story_title = htmlspecialchars($story_title);
  $story_text = htmlspecialchars($story_text);

  // check if there is a reference to a user
  preg_match_all('#(?<=\/u\/).+?(?=\/)#', $story_text, $matches);

  foreach ($matches as $match) {
    if ($match) {
      $user = getUserProfile($match[0]);

      if ($user) {
        $search = '#\/u\/' . $match[0] . '\/#';
        $replace =  '<a href="./profile.php?user=' . $match[0] . '" class="author-name">' . $match[0] . '</a>';
        $story_text = preg_replace($search, $replace, $story_text);
      }
    }
  }

  // check if there is a reference to a channel
  preg_match_all('#(?<=\/c\/).+?(?=\/)#', $story_text, $matches);

  foreach ($matches as $match) {
    if ($match) {
      $channel = get_channel_info($match[0]);

      if ($channel) {
        $search = '#\/c\/' . $match[0] . '\/#';
        $replace =  '<a href="./channel.php?name=' . $match[0] . '" class="sc_channel">' . $match[0] . '</a>';
        $story_text = preg_replace($search, $replace, $story_text);
      }
    }
  }

  $Parsedown = new \Parsedown();
  $story_text = $Parsedown->text($story_text);

  createStory($channel_name, $username, $story_title, $story_text);

  die('ok');

?>