<?php function draw_login() {
/**
 * Draws the login section.
 */ ?>
  <section id="auth">
    
    <header><h2>Welcome Back</h2></header>

    <form method="post" action="../actions/action_login.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Login" class="button button-auth">
      <p>Don't have an account? <a href="signup.php">Sign up here!</a></p>
    </form>

  </section>
<?php } ?>

<?php function draw_signup() { 
/**
 * Draws the signup section.
 */ ?>
  <section id="auth">

    <header><h2>New Account</h2></header>

    <form method="post" action="../actions/action_signup.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Signup" class="button button-auth">
      <p>Already have an account? <a href="login.php">Login!</a></p>
    </form>

  </section>
<?php } ?>