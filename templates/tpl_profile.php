<?php 
	include_once('../includes/session.php');
	include_once('../database/db_user.php');

	function draw_profile($username, $profile_pic, $bio, $points) {?>
	<section id="profile" class="profile">
		<aside id="profile-info" class="aside">
			<img class="aside-img" style="background: url('<?=$profile_pic?>') no-repeat center bottom; background-size: 50%;" alt="profile picture">
			<h1 class="aside-header-text"><?=$username?></h1>
			<p class="aside-body-text">Points: <?=$points?></p>
			<p class="aside-body-text"><?=$bio?></p>
			<?php if($username == $_SESSION['username']) {?>
				<footer>
					<p><a href="../pages/edit_profile.php">Edit Profile</a></p>
				</footer>
			<?php } ?>
		</aside>
		<?php
			$stories = getStories(0);
			draw_story_cards($stories);
		?>
	</section>
<?php } ?>