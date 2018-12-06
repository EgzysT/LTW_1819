<?php 
	include_once('../includes/session.php');
	include_once('../database/db_user.php');

	function draw_edit_profile($username, $profile_pic, $bio) {?>
		<section id="edit-profile-section">
			<h1>Edit Your Profile:</h1>
			<!-- <h3>Username: <?=$username?></h3> -->
			<form method="post" action="../actions/action_upload_profile.php" id="edit-profile-form" enctype="multipart/form-data">
				<h3>Profile Picture:</h3>
				<img src=<?=$profile_pic?> alt="profile picture">
				<p>Upload new profile picture: </p>
				<input type="file" name="newProfilePic" id="newProfilePic" accept=".jpg,.png,.jpeg,.gif">
				<h3>Bio:</h3>
				<textarea name="bio" rows="5" cols="50"><?=$bio?></textarea>
				<input class="button button-blue" type="submit" name="submit" value="Save Profile">
			</form>
		</section>
<?php } ?>