<?php 

  if(!isset($_GET['name']))
    header('Location: ./main.php');

  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');
  include_once('../templates/tpl_asides.php');
  include_once('../database/db_story.php');
  include_once('../database/db_user.php');
  include_once('../database/db_channel.php');

  $page_title = 'Bluedit';
  $username = $_SESSION['username'];

  $channel_name = $_GET['name'];
  $current_page_channel = get_channel_info($channel_name);

  if(!$current_page_channel) { // Channel doesn't exist.
    header('Location: ./main.php');
  }

  draw_header($username, $page_title); ?>

  <section class="channel">
    
    <?php  
      $stories = getStories(0);
      draw_story_cards($stories); 
      ?> 

      <section class="aside-container">
        <?php 
          if($username) { 
            $is_subscribed = false;
            $subscribed_channels = getSubscribedChannels($username);
            if($username) { // See if user is subscribed to current page channel.
              foreach($subscribed_channels as $subscribed_channel) 
                if($subscribed_channel->name === $current_page_channel->name)
                  $is_subscribed = true;
            }
            draw_channel_aside($current_page_channel, $is_subscribed);
            draw_subscriptions_aside($subscribed_channels);
          }
          else {
            draw_channel_aside($current_page_channel, null);
          }
          ?>
      </section>
  </section>

  <?php

  draw_footer();

?>