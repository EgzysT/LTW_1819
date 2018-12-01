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
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
      <link rel="stylesheet" href="../css/style.css">
      <link href="https://fonts.googleapis.com/css?family=Merriweather|Open+Sans+Condensed:300" rel="stylesheet">
      <script src="../js/main.js" defer></script>
    </head>

    <body>

      <header>
        <div class="container">
          <h1><a href="main.php"><i class="far fa-flushed" id="logo-icon"></i> Blueit</a></h1>
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
                <li><a href="../pages/login.php">Login</a></li><li><a href="../pages/signup.php">Signup</a></li>
              </ul>
            </nav>
          <?php } ?>
        </div>
      </header>
      <div class="container">
<?php } ?>

<?php function draw_messages() { 
    if (isset($_SESSION['messages'])) {?>
        <section id="messages">
            <?php foreach($_SESSION['messages'] as $message) { ?>
              <div class="<?=$message['type']?>"><?=$message['content']?></div>
            <?php } ?>
        </section>
<?php unset($_SESSION['messages']); } } ?>

<?php function draw_footer() { 
/**
 * Draws the footer for all pages.
 */ ?>
   </div>
  </body>
</html>
<?php } ?>