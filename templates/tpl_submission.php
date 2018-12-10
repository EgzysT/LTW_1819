<?php function draw_story_submission_form($channel_name) { 
    /**
     * Draws a section (#submission) containing the submit story form.
     */ ?>
    <section id="submission" class="panel">
    
      <header class="orange-header"><h2><i class="fas fa-pen-fancy"></i> &nbsp;Submit Story</h2></header>
    
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
        <form method="post" action="../actions/action_login.php" id="submit-story-form">
          <input type="text" name="story_title" placeholder="story title" minlength="10" maxlength="100" required>
          <textarea name="story_text" rows="10" placeholder="story text" minlength="70" maxlength="2500"></textarea>
          <div class="submit-container">
            <div class="channel-name">
              <a href="./channel.php?name=<?=$channel_name?>">#<?=$channel_name?></a>
            </div>
            <input type="submit" value="Submit" class="button button-blue">
          </div>
        </form>
      </div>

    </section>

<?php } ?>