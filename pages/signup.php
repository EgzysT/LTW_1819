<?php 
  // include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');


  draw_header(null);
  draw_signup();
  draw_messages();
  draw_footer();
?>