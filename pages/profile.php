<?php 
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');
  include_once('../templates/tpl_profile.php');
  include_once('../database/db_story.php');

  $page_title = 'Bluedit - Profile';

  $username = $_SESSION['username'];
	
	if(isset($_GET['user'])) {
		$username = $_GET['user'];
	}

	//TODO: check if it exists, watch out for safety from GET username
  $profile_pic = "https://picsum.photos/150/?random";
  $bio = "This is my bio, deal with it. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mauris elit, pharetra vitae ipsum eget, elementum elementum elit. Mauris vulputate ultricies arcu, in egestas leo. Donec vel justo ut nunc gravida faucibus. Vestibulum elementum, erat molestie elementum convallis, ligula nunc sollicitudin metus, id lacinia ante diam dapibus lacus. Nulla facilisi. Etiam blandit erat nisl, nec vulputate lacus euismod luctus. Aenean iaculis iaculis nunc.";
  $points = 100;

  draw_header($username, $page_title);
	draw_profile($username, $profile_pic, $bio, $points);
  draw_footer();
?>