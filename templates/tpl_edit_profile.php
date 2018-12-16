<?php 
	function draw_edit_profile($profile) {
	/**
   * Draws the editor profile panel.
   */
		?>
		<section class="panel" id="edit-profile">

      <header><h2><i class="fas fa-pen-fancy"></i> &nbsp;Edit profile</h2></header>

      <div id="ajax-form-container">
        <!-- Ajax related HTML comes first -->
        <div id="ajax-form-request-fill">
          <i class="fas fa-cog fa-2x fa-spin"></i>
        </div>
        <div id="ajax-form-failure-fill">
          <strong>
            <span id="error-message"></span>
            <button class="button button-block button-red">Retry</button>
          </strong>
        </div>
        <div id="ajax-form-success-fill">
          <i class="fas fa-check fa-2x"></i>
        </div>
        <!-- Non-ajax stuff -->
        <div id="edit-main">
          <form method="post" action="../actions/action_upload_profile.php" class="edit-profile-form" enctype="multipart/form-data">
            <h3 class="username">/u/<?=$profile->username?>/</h3>
            <h4 class="email"><?=$profile->email?></h4>
            <div id="avatar" style="background-image: url('<?=$profile->profile_pic?>')">
                <label class="custom-file-upload">
                    <input type="file" name="newProfilePic"/>
                    <span class="fa-stack fa-2x">
                        <i class="far fa-square fa-stack-2x"></i>
                        <i class="fas fa-upload fa-stack-1x"></i>
                    </span>
              </label>
            </div>
            <h3>Tell us a little about yourself:</h3>
            <textarea name="bio" rows="5" cols="50"><?=$profile->bio?></textarea>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <input class="button button-blue" value="Save" type="submit" name="submit">
          </form>
        </div>
        <div id="edit-email">
          <form method="post" action="../actions/action_change_email.php" class="edit-profile-form" autocomplete="off">
          <h3>Change Email:</h3>
          <input type="password" name="password" placeholder="current password" autocomplete="off">
          <input type="email" name="newEmail" autocomplete="off" placeholder="new email">
          <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
          <input class="button button-blue" type="submit" name="submit" value="Save">
        </form>
        </div>
        <div id="edit-password">
          <form method="post" action="../actions/action_change_password.php" class="edit-profile-form">
            <h3>Change Password:</h3>
            <input type="password" name="currPassword" placeholder="current password">
            <input type="password" name="newPassword1" placeholder="new password">
            <input type="password" name="newPassword2" placeholder="confirm new password">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <input class="button button-blue" type="submit" name="submit" value="Save">
          </form>
        </div>
      </div>
		</section>
<?php } ?>