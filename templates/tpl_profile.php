<?php 
	include_once('../includes/session.php');
	include_once('../database/db_user.php');

	function draw_profile($username, $profile_pic, $bio, $points) {?>
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

<?php function draw_main_aside() {
/**
 * Draws the aside for the main page.
 */ ?>
    
    <aside id="main-aside" class="aside">
        <div class="aside-img"> </div>
        <h3 class="aside-header-text">Meaningful Stories</h3>
        <p class="aside-body-text">Stories worth reading about life and technology. Crafted with pen and passion by our community.</p>
        <footer>
            <button class="button button-green button-channel-subscription button-180Y-rotate" id="subscribe"> Subscribe </button>
            <button class="button button-red button-channel-subscription" id="unsubscribe"> Unsubscribe </button>
            <!--<button class="button button-blue"> Search </button>
            <button class="button button-orange"> Something Else </button>-->
        </footer>
    </aside>
<?php } ?>