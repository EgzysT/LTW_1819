<?php function draw_main_aside() {
/**
 * Draws the aside for the main page.
 */ ?>
    
    <aside class="aside" id="main-aside">
        <div class="aside-img"> </div>
        <h3 class="aside-header-text">Blueit</h3>
        <p class="aside-body-text">Stories worth reading about life and technology. Crafted with pen and passion by our community.</p>
    </aside>

<?php }

function draw_channel_aside() {
/**
 * Draws the aside for a specific channel.
 */ ?>
    
    <aside class="aside">
        <div class="aside-img"> </div>
        <h3 class="aside-header-text">Blueit</h3>
        <p class="aside-body-text">O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500.</p>
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
function draw_subscriptions_aside() {
/**
 * Draws the aside for a specific channel.
 */ ?>
    
    <aside class="aside">
        <header>
            <h4>Subscriptions</h4>
        </header>
        <ul class="subscribed-channels">
            <li>
                <i class="fas fa-bookmark"></i>&nbsp; science 
                <div class="channel-background"></div> 
            </li>
            <li>
                <i class="fas fa-bookmark"></i>&nbsp; technology
                <div class="channel-background"></div> 
            </li>
        </ul>
    </aside>
<?php } ?>