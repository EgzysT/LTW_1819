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
  $channel = get_channel_info($channel_name);

  if(!$channel) { // Channel doesn't exist.
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
          draw_channel_aside($channel);
          if($username) { 
            $subscribed_channels = getSubscribedChannels($username);
            draw_subscriptions_aside($subscribed_channels);
          }
          ?>
      </section>
  </section>

  <?php

  draw_footer();

?>