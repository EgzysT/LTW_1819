<?php 
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');
  include_once('../templates/tpl_asides.php');
  include_once('../database/db_story.php');

  $page_title = 'Bluedit';
  $username = $_SESSION['username'];

  draw_header($username, $page_title); ?>

  <section class="channel">
    
    <?php  
      $stories = getStories(0);
      draw_story_cards($stories); 

      draw_main_aside();
    ?>
  </section>

  <?php

  draw_footer();

?>