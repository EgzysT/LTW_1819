<?php 
	function draw_edit_profile($username, $profile_pic, $bio, $email) {?>
		<section id="edit-profile-section">
			<h1>Edit Your Profile:</h1>
			<form method="post" action="../actions/action_upload_profile.php" class="edit-profile-form" enctype="multipart/form-data">
				<h3>Profile Picture:</h3>
				<img src=<?=$profile_pic?> alt="profile picture">
				<p>Upload new profile picture: </p>
				<input type="file" name="newProfilePic" id="newProfilePic" accept=".jpg,.png,.jpeg,.gif">
				<h3>Bio:</h3>
				<textarea name="bio" rows="5" cols="50"><?=$bio?></textarea>
				<input class="button button-blue" type="submit" name="submit">
			</form>
			<form method="post" action="../actions/action_change_email.php" class="edit-profile-form" autocomplete="off">
				<h3>Change Email:</h3>
				Password: <input type="password" name="password" placeholder="password" autocomplete="off">
				New email: <input type="email" name="newEmail" placeholder="New Email" autocomplete="off" value="<?=$email?>">
				<input class="button button-blue" type="submit" name="submit" value="Save">
			</form>
			<form method="post" action="../actions/action_change_password.php" class="edit-profile-form">
				<h3>Change Password:</h3>
				<p>Current Password:</p>
				<input type="password" name="currPassword" placeholder="Current Password">
				<p>New Password:</p>
				<input type="password" name="newPassword1" placeholder="New Password">
				<p>Verify Password:</p>
				<input type="password" name="newPassword2" placeholder="Verify Password">
				<input class="button button-blue" type="submit" name="submit" value="Save">
			</form>
		</section>
<?php } ?>