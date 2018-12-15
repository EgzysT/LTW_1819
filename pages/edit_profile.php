<?php 
	include_once('../includes/session.php');
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_edit_profile.php');
	include_once('../database/db_user.php');


	$page_title = 'Bluedit - Edit Profile';
	$username = $_SESSION['username'];

	$profile = getUserProfile($username);
	//TODO: check if it exists, watch out for safety from GET username
  $profile_pic = $profile->profile_pic;
	$bio = $profile->bio;
	$points = $profile->points;
	$email = $profile->email;
	
	if($profile_pic == NULL) {
		$profile_pic = "../assets/profile_pics/0.jpg";
	}
	if($bio == NULL) {
		$bio = "This misterious stranger has no bio yet! :o";
	}
	if($email == NULL) {
		echo("Database Error: NULL email, please contact us in order to resolve this issue!");
	}

	draw_header($username, $page_title);
	draw_edit_profile($username, $profile_pic, $bio, $email);
  draw_footer();
?>