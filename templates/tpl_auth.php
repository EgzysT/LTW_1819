<?php function draw_login() {
/**
 * Draws the login section.
 */ ?>
  <section id="auth" class="panel">
    
    <header><h2>Welcome Back</h2></header>
  
    <div id="ajax-form-container">
      <!-- Ajax related HTML comes first -->
      <div id="ajax-form-request-fill">
        <i class="fas fa-cog fa-2x fa-spin"></i>
      </div>
      <div id="ajax-form-failure-fill">
        <strong>
          Wrong username or password.
          <button class="button button-block button-red">Retry</button>
        </strong>
      </div>
      <div id="ajax-form-success-fill">
        <i class="fas fa-check fa-2x"></i>
      </div>
      <!-- Form -->
      <form method="post" action="../actions/action_login.php" id="login-form">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" value="Login" class="button button-blue">
        <p>Don't have an account? <a href="signup.php">Sign up here!</a></p>
      </form>
    </div>

  </section>
<?php } ?>

<?php function draw_signup() { 
/**
 * Draws the signup section.
 */ ?>
  <section id="auth" class="panel">

    <header><h2>New Account</h2></header>

    <div id="ajax-form-container">
      <!-- Ajax related HTML comes first -->
      <div id="ajax-form-request-fill">
        <i class="fas fa-cog fa-2x fa-spin"></i>
      </div>
      <div id="ajax-form-failure-fill">
        <strong>
          <span id="error-message"></span>
          <button class="button button-block button-red">Retry</button>
        </strong>
      </div>
      <div id="ajax-form-success-fill">
        <i class="fas fa-check fa-2x"></i>
      </div>
      <!-- Form -->
      <form method="post" action="../actions/action_signup.php" id="signup-form">
        <input type="text" name="username" placeholder="username" required>
        <input type="email" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="password" name="confirm_password" placeholder="confirm password">
        <input type="submit" value="Signup" class="button button-blue">
        <p>Already have an account? <a href="login.php">Login!</a></p>
      </form>
    </div>

  </section>
<?php } ?>