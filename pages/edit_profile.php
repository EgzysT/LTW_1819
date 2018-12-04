<?php 
	include_once('../includes/session.php');


	$page_title = 'Bluedit - Profile';
	$username = $_SESSION['username'];

	$profile_pic = "https://picsum.photos/150/?random";
  $bio = "This is my bio, deal with it. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mauris elit, pharetra vitae ipsum eget, elementum elementum elit. Mauris vulputate ultricies arcu, in egestas leo. Donec vel justo ut nunc gravida faucibus. Vestibulum elementum, erat molestie elementum convallis, ligula nunc sollicitudin metus, id lacinia ante diam dapibus lacus. Nulla facilisi. Etiam blandit erat nisl, nec vulputate lacus euismod luctus. Aenean iaculis iaculis nunc.";


	draw_header($username, $page_title);
	draw_edit_profile($username, $profile_pic, $bio);
  draw_footer();
?>