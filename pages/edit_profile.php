<?php 
	include_once('../includes/session.php');
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_edit_profile.php');
	include_once('../database/db_user.php');


	$page_title = 'Bluedit - Edit Profile';
	$username = $_SESSION['username'];

	if(!$username)
    die(header('Location: ../pages/main.php'));

	$profile = getUserProfile($username);
	
	draw_header($username, $page_title);
	draw_edit_profile($profile);
  draw_footer();
?>