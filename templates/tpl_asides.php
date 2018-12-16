<?php function draw_main_aside() {
/**
 * Draws the aside for the main page.
 */ ?>
    
    <aside class="aside" id="main-aside">
        <div class="aside-img"> </div>
        <h3 class="aside-header-text">Blueit</h3>
        <p class="aside-body-text">Stories worth reading about life and technology. Crafted with pen and passion by our community.</p>
        <footer>
            <div>
                <button class="button button-blue button-block" id="search-button"> Search </button>
                <?php if($_SESSION['username']){ ?>
                <button class="button button-orange button-block" id="create-channel-button"> Create Channel </button>
                <?php } ?>
            </div>
        </footer>
    </aside>

    <aside class="aside rotate-180Y no-display hidden" id="create-channel-aside">
        <header class="orange-header">
            <h4>Create Channel</h4>
        </header>
        <div id="ajax-form-container">
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
            <form method="post" action="#" id="create-channel-form" enctype="multipart/form-data">
                <div id="channel-upload-image">
                <label class="custom-file-upload">
                    <input type="file" name="image"/>
                    <span class="fa-stack fa-2x">
                        <i class="far fa-square fa-stack-2x"></i>
                        <i class="fas fa-upload fa-stack-1x"></i>
                    </span>
                </label>
                </div>
                <input type="text" name="channel_name" placeholder="channel name" maxlength="8" required>
                <input type="text" name="channel_description" placeholder="channel description" maxlength="100" required>
                <input type="submit" value="Create Channel" class="button button-blue button-block">
                <button class="button button-red button-block cancel-button">Cancel</button>
            </form>
        </div>
    </aside>
<?php }

function draw_channel_aside($current_channel, $is_subscribed) {
/**
 * Draws the aside for a specific channel.
 */ ?>
    
    <aside class="aside aside-channel with-subscribe">
        <div class="aside-img" style="background: url('<?=$current_channel->image?>') no-repeat center bottom; background-size: 50%;"> </div>
        <h3 class="aside-header-text">#<span id="channel_name"><?=$current_channel->name?></span></h3>
        <p class="aside-body-text"><?=htmlspecialchars($current_channel->description)?></p>
        <footer>
            <?php if($_SESSION['username']){ ?>
            <div>
                <button class="button button-green button-block button-channel-subscription <?php if($is_subscribed){ ?>rotate-180Y<?php } ?>" id="subscribe"> Subscribe </button>
                <button class="button button-red button-block button-channel-subscription <?php if(!$is_subscribed){ ?>rotate-180Y<?php } ?>" id="unsubscribe"> Unsubscribe </button>
            </div> 
            <div>
                <a href="./submit_story.php?channel=<?=$current_channel->name?>"><button class="button button-orange button-block"> Tell us your story </button></a>
            </div> 
            <?php } ?>
            <div>
                <button class="button button-blue button-block" id="search-button"> Search </button>
            </div> 
        </footer>
        <footer>
            
        </footer>
    </aside>
    <aside class="aside rotate-180Y no-display hidden" id="search-aside">
        <header>
            <h4>Search</h4>
        </header>
        <h3 class="aside-header-text">Blueit</h3>
        <p class="aside-body-text">Stories worth reading about life and technology. Crafted with pen and passion by our community.</p>
    </aside>

<?php }
function draw_channels_aside($channels, $header_text) {
/**
 * Draws the aside for a specific channel.
 */ ?>
    
    <aside class="aside">
        <header>
            <h4><?=$header_text?></h4>
        </header>
        <ul class="subscribed-channels">
            <?php
            foreach($channels as $channel) { ?>
                <li>
                    <i class="fas fa-bookmark"></i>&nbsp; <a href="./channel.php?name=<?=$channel->name?>"><?=$channel->name?></a>
                    <div class="channel-background" style="background: url('<?=$channel->image?>') no-repeat center center; background-size: 105%"></div> 
                </li>
            <?php } ?>
        </ul>
    </aside>
<?php }

/**
 * Draws the profile aside. It contains the specified user's avatar, points and number of stories and comments published.
 */
function draw_aside_profile($profile) {?>
    <aside id="profile-info" class="aside">
        <div class="avatar-container">
            <img src=<?=$profile->profile_pic?> alt="profile picture">
        </div>
        <h1 class="aside-header-text"><?=$profile->username?></h1>
        <p class="aside-body-text"><?=htmlspecialchars($profile->bio)?></p>
        <div class="account-activity">
            <p class="aside-body-text" title="Points"><i class="fas fa-balance-scale"></i> <?=$profile->points?></p>
            <p class="aside-body-text" title="Stories"><i class="fas fa-book"></i> <?=$profile->stories?></p>
            <p class="aside-body-text" title="Comments"><i class="fas fa-comment"></i> <?=$profile->comments?></p>
        </div>
        <?php if($profile->username == $_SESSION['username']) {?>
            <footer>
                    <a href="../pages/edit_profile.php"><button class="button button-blue button-block">Edit Profile</button></a>     
            </footer>
        <?php } else if (strpos($_SERVER['REQUEST_URI'], 'profile') === false){ ?>
            <footer>
                <a href="../pages/profile.php?user=<?=$profile->username?>"><button class="button button-blue button-block">View Profile</button></a>
            </footer>
        <?php } ?>
    </aside>

<?php } ?>

