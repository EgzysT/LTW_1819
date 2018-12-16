<?php 

  if(!isset($_GET['id']))
    die(header('Location: ./main.php'));

  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');
  include_once('../templates/tpl_asides.php');
  include_once('../database/db_story.php');
  include_once('../database/db_user.php');
  include_once('../database/db_post.php');

  $username = $_SESSION['username'];

  $story_id = $_GET['id'];
  $current_story = getStory($story_id);
  
  if(!$current_story)
    die(header('Location: ./main.php'));

  $comments = getComments($story_id, $username);

  $page_title = 'Bluedit';

  if(!$current_story) { // Story doesn't exist.
    die(header('Location: ./main.php'));
  }

  $profile = getUserProfile($current_story->author_name);

  // See if user already upvoted / downvoted.
  $vote_type = NULL;
  
  if($username)
    $vote_type = get_vote($username, $current_story->id);

  // checks if the user is loged in to know if it should print the comment form
  if($_SESSION['username'])
    $logged_in = true;
  else
    $logged_in = false;

    $content = $current_story->content;


  draw_header($username, $page_title);  ?>

  	<section id="one-story" class="one-story">
      <?php
          draw_aside_profile($profile);
          draw_full_story_card($current_story, $comments, $vote_type);
          draw_comments($comments, $story_id, $logged_in);
      ?>
	  </section>

  <?php draw_footer(); ?>
