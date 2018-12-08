<?php function draw_submit_story_aside($channel_name) {
/**
 * Draws the modal for a story submission.
 */ ?>
 <section class="modal modal-submit-story container no-display">
    <header class="orange-header">
        Submit Story
    </header>
    <form method="post" action="#" id="submit-story-form">
        <input type="text" name="story_name" placeholder="story name" maxlength="60" required>
        <textarea type="text" name="story_text" placeholder="story text" maxlength="2500" required></textarea>
        <input type="submit" value="Create Channel" class="button button-blue button-block">
        <button class="button button-red button-block cancel-button">Cancel</button>
    </form>
 </section>

<?php }

function draw_modal_outer_background() {
/**
 * Draws the grey body background for when a modal is active.
 */ ?>
 <div id="modal-outer-background no-display">
 </div>
 
<?php } ?>