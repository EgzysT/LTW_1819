<?php 

  if(!isset($_GET['id']))
    die(header('Location: ./main'));

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
    die(header('Location: ./main'));

  $comments = getComments($story_id, $username);

  $page_title = 'Bluedit';

  $profile = getUserProfile($current_story->author_name);

  // See if user already upvoted / downvoted.
  $vote_type = NULL;
  
  if($username)
    $vote_type = get_vote($username, $current_story->id);


  draw_header($username, $page_title);  ?>

  	<section id="one-story" class="one-story">
      <?php
          draw_aside_profile($profile);
          draw_full_story_card($current_story, $comments, $vote_type);
          draw_comments($comments, $story_id, $username);
      ?>
	  </section>

  <?php draw_footer(); ?>
