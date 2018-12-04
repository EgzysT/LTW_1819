<?php 
	include_once('../includes/session.php');
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_edit_profile.php');
	include_once('../database/db_user.php');


	$page_title = 'Bluedit - Edit Profile';
	$username = $_SESSION['username'];

	$profile = getUserProfile($username);
	//TODO: check if it exists, watch out for safety from GET username
  $profile_pic = $profile->profile_pic; //"https://picsum.photos/150/?random";
  $bio = $profile->bio; //"This is my bio, deal with it. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mauris elit, pharetra vitae ipsum eget, elementum elementum elit. Mauris vulputate ultricies arcu, in egestas leo. Donec vel justo ut nunc gravida faucibus. Vestibulum elementum, erat molestie elementum convallis, ligula nunc sollicitudin metus, id lacinia ante diam dapibus lacus. Nulla facilisi. Etiam blandit erat nisl, nec vulputate lacus euismod luctus. Aenean iaculis iaculis nunc.";
	$points = $profile->points; //100;
	
	if($profile_pic == NULL) {
		$profile_pic = "../assets/profile_pics/0.jpg";
	}
	if($bio == NULL) {
		$bio = "This misterious stranger has no bio yet! :o";
	}

	draw_header($username, $page_title);
	draw_edit_profile($username, $profile_pic, $bio);
  draw_footer();
?>