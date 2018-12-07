<?php 

  if(!isset($_GET['id']))
    die(header('Location: ./main.php'));


  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');
  include_once('../templates/tpl_asides.php');
  include_once('../templates/tpl_profile.php');
  include_once('../database/db_story.php');
  include_once('../database/db_user.php');
  include_once('../database/db_post.php');

  $username = $_SESSION['username'];

  $story_id = $_GET['id'];
  $current_story = getStory($story_id);
  $comments = getComments($story_id);

  $page_title = 'Bluedit';

  if(!$current_story) { // Story doesn't exist.
    die(header('Location: ./main.php'));
  }

  $profile = getUserProfile($current_story->author_name);
  $profile_pic = $profile->profile_pic; 
  $bio = $profile->bio; 
  $points = $profile->points; 

  // See if user already upvoted / downvoted.
  $vote_type = NULL;
  
  if($username)
    $vote_type = get_vote($username, $current_story->id);


  // checks if the user is loged in to know if it should print the comment form
  if($_SESSION['username'])
    $loged_in = true;
  else
    $loged_in = false;


  draw_header($username, $page_title);  ?>

  	<section id="one-story" class="one-story">
      <?php
          draw_aside_profile($username, $profile_pic, $bio, $points);
          draw_full_story_card($current_story, $vote_type);
          draw_comments($comments, $story_id, $loged_in);
      ?>
	  </section>

  <?php draw_footer(); ?>
