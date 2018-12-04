<?php 
	include_once('../includes/session.php');
	include_once('../database/db_user.php');

	function draw_edit_profile($username, $profile_pic, $bio) {?>
	<section id="profile" class="profile">
		<aside id="profile-info" class="aside">
			<?php if($username == $_SESSION['username']) {?>
				<p><a href="../pages/editprofile.php">Edit Profile</a></p>
			<?php } ?>
			<img class="aside-img" src=<?=$profile_pic?> alt="profile picture">
			<h1 class="aside-header-text"><?=$username?></h1>
			<p class="aside-body-text">Points: <?=$points?></p>
			<p class="aside-body-text"><?=$bio?></p>
			<?php if($username == $_SESSION['username']) {?>
				<footer>
					<p><a href="../pages/editprofile.php">Edit Profile</a></p>
				</footer>
			<?php } ?>
		</aside>
		<?php
			$stories = getStories(0);
			draw_story_cards($stories);
		?>
	</section>
<?php } ?>