<?php 
  /**
   * Draws the submit story page
   */
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_submission.php');
  include_once('../database/db_channel.php');


  if(!$_SESSION['username'])
    die(header('Location: ../pages/main'));

	$channel_name = $_GET['channel'];

	// Redirect user to main page if channel doesn't exist.
  if(!get_channel_info($channel_name)) {
    die(header('Location: ../pages/main'));
	}

	$username = $_SESSION['username'];

	$page_title = 'Bluedit - Submit Story';
	
	
	draw_header($username, $page_title);
	draw_story_submission_form($channel_name);
	draw_footer();
	
?>