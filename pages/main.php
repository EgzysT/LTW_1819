<?php 
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_story_cards.php');

  $page_title = 'Bluedit';

  $username = $_SESSION['username'];

  draw_header($username, $page_title);
  draw_footer();

?>