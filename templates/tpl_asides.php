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
                <button class="button button-blue button-block"> Search </button>
            </div>
        </footer>
    </aside>

<?php }

function draw_channel_aside($current_channel) {
/**
 * Draws the aside for a specific channel.
 */ ?>
    
    <aside class="aside aside-channel">
        <div class="aside-img" style="background: url('<?=$current_channel->image?>') no-repeat center bottom; background-size: 50%;"> </div>
        <h3 class="aside-header-text">#<?=$current_channel->name?></h3>
        <p class="aside-body-text"><?=$current_channel->description?></p>
        <footer>
            <div>
                <button class="button button-green button-block button-channel-subscription button-180Y-rotate" id="subscribe"> Subscribe </button>
                <button class="button button-red button-block button-channel-subscription" id="unsubscribe"> Unsubscribe </button>
            </div> 
            <!-- <button class="button button-blue"> Search </button>-->
            <div>
                <button class="button button-orange button-block"> Tell us your story </button>
            </div> 
            <div>
                <button class="button button-blue button-block"> Search </button>
            </div> 
        </footer>
    </aside>

<?php }
function draw_subscriptions_aside($subscribed_channels) {
/**
 * Draws the aside for a specific channel.
 */ ?>
    
    <aside class="aside">
        <header>
            <h4>Subscriptions</h4>
        </header>
        <ul class="subscribed-channels">
            <?php
            foreach($subscribed_channels as $channel) { ?>
                <li>
                    <i class="fas fa-bookmark"></i>&nbsp; <a href="http://localhost:8080/ltw/pages/channel.php?name=<?=$channel->name?>"><?=$channel->name?></a>
                    <div class="channel-background" style="background: url('<?=$channel->image?>') no-repeat center center; background-size: 105%"></div> 
                </li>
            <?php } ?>
        </ul>
    </aside>
<?php } ?>