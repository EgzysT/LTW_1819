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

  $username = $_SESSION['username'];

  $story_id = $_GET['id'];
  $current_story = getStory($story_id);

  $page_title = 'Bluedit';

  if(!$current_story) { // Story doesn't exist.
    die(header('Location: ./main.php'));
  }

  $profile = getUserProfile($current_story->author_name);
  $profile_pic = $profile->profile_pic; 
  $bio = $profile->bio; 
  $points = $profile->points; 


  draw_header($username, $page_title);  ?>

  	<section id="one-story" class="one-story">
      <?php
          draw_aside_profile($username, $profile_pic, $bio, $points);
          draw_full_story_card($current_story);
      ?>
	  </section>

  <?php draw_footer(); ?>
