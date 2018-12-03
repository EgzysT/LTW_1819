<?php 
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');
  include_once('../templates/tpl_asides.php');
  include_once('../database/db_story.php');
  include_once('../database/db_user.php');

  $page_title = 'Bluedit';
  $username = $_SESSION['username'];

  draw_header($username, $page_title); ?>

  <section class="channel">
    
    <?php  
      $stories = getStories(0);
      draw_story_cards($stories); 
      ?> 

      <section class="aside-container">
      <?php 

        draw_main_aside();
        
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