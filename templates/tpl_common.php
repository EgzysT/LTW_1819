<?php function draw_header($username, $page_title) { 
/**
 * Draws the header for all pages. Receives an username
 * if the user is logged in in order to draw the logout
 * link.
 */?>
  <!DOCTYPE html>
  <html>

    <head>
      <title><?=$page_title?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
      <link rel="stylesheet" href="../css/style.css">
      <link href="https://fonts.googleapis.com/css?family=Merriweather|Open+Sans+Condensed:300|Lato" rel="stylesheet">
      <link rel="icon" href="../assets/favicon2.ico">
      <script src="../js/main.js" defer></script>
    </head>

    <body>

      <header>
        <div class="container">
          <h1><a href="main.php"><i class="far fa-flushed" id="logo-icon"></i> Blueit</a></h1>
          <?php if ($username != NULL) { ?>
            <nav>
              <div class="dropdown">
                <span class="dropdown_btn">
                  <a><?=$username?></a>
                  <a><i class="fas fa-caret-down"></i></a>
                </span>
                <div class="dropdown_content">
                  <a href=""><i class="fas fa-user"></i>  Profile</a>
                  <a href="../actions/action_logout.php"><i class="fas fa-sign-out-alt"></i>  Logout</a>
                </div>
              </div>
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
   <footer>
    Made with <i class="fas fa-heart"></i> by Ana Silva, Fábio Oliveira and Ricardo Teixeira.
   </footer>
  </body>
</html>
<?php } ?>