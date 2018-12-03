<?php
	include_once('../includes/session.php');
	include_once('../database/db_user.php');

	function draw_user_profile($username, $profile_pic, $bio, $points) {?>
		<section id="profile">
			<img src=<?=$profile_pic?> alt="profile picture">
			<h1><?=$username?></h1>
			<p>Points: <?=$points?></p>
			<form action="POST">
				<input type="submit" value="Edit Profile" class="button button-blue">
			</form>
			<p><?=$bio?></p>
		</section>
<?php } ?>