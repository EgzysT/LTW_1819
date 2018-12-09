<?php 
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');
  include_once('../templates/tpl_asides.php');
  include_once('../database/db_story.php');
  include_once('../database/db_user.php');
  include_once('../database/db_channel.php');

  $page_title = 'Bluedit';
  $username = $_SESSION['username'];

  draw_header($username, $page_title); ?>

  <section class="channel">
    
    <?php
      $stories;
      if ($username && count(getSubscribedChannels($username)) !== 0) {
        $stories = getStories(['subscribed_by' => $username]);
      } 
      else {
        $stories = getStories([]);
      } 
      // $stories = $username ? getStories(['subscribed_by' => $username]) : getStories([]);
      draw_story_cards($stories); 
      ?> 

      <section class="aside-container">
      <?php 

        draw_main_aside();
        
        if($username) { 
          $subscribed_channels = getSubscribedChannels($username);
          draw_channels_aside($subscribed_channels, 'Subscriptions');
        }
        else {
          $channels = get_all_channels();
          draw_channels_aside($channels, 'All Channels');
        }
      ?>
    </section>
  </section>

  <?php

  draw_footer();

?>