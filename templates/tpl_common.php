<?php function draw_header($username) { 
/**
 * Draws the header for all pages. Receives an username
 * if the user is logged in in order to draw the logout
 * link.
 */?>
  <!DOCTYPE html>
  <html>

    <head>
      <title>Blueit</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Merriweather|Open+Sans+Condensed:300" rel="stylesheet">
      <script src="../js/main.js" defer></script>
    </head>

    <body>

      <header>
        <h1><a href="login.php"><i class="far fa-flushed"></i> Blueit</a></h1>
        <?php if ($username != NULL) { ?>
          <nav>
            <ul>
              <li><?=$username?></li>
              <li><a href="../actions/action_logout.php">Logout</a></li>
            </ul>
          </nav>
        <?php } else { ?>
          <nav>
            <ul>
              <li><a href="../actions/action_logout.php">Login</a></li>
              <li><a href="../actions/action_signup.php">Signup</a></li>
            </ul>
          </nav>
        <?php } ?>
      </header>
<?php } ?>

<?php function draw_footer() { 
/**
 * Draws the footer for all pages.
 */ ?>
  </body>
</html>
<?php } ?>