<?php 
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');
	include_once('../templates/tpl_asides.php');
	include_once('../database/db_user.php');
  include_once('../database/db_story.php');

	$username = $_SESSION['username'];
	
	
  $page_title = 'Bluedit /u/'.$username;
	
	if(isset($_GET['user'])) {
		$username = $_GET['user'];
	}

	$profile = getUserProfile($username);

	if(!$profile) { // Profile doesn't exist
    header('Location: ./main');
  }

	draw_header($username, $page_title);
	
	?>
	<section id="profile" class="profile">
		<?php 
			draw_aside_profile($profile);
			$stories = getStories(['author' => $username]);
			draw_story_cards($stories);
		?>
	</section>

	<?php 
	draw_footer();
?>