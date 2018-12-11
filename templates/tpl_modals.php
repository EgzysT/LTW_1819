<?php function draw_search_modal($GET = []) {
/**
 * Draws the modal for a story submission.
 */ ?>
 <div class="modal-container">
  <section class="modal modal-search no-display">
      <header>
        <span class="modal-close">
          <i class="fas fa-times"></i>
        </span>
        <i class="fas fa-search"></i> Search Content
      </header>
      <form method="get" action="./search.php" id="search-form">
          <!--<div class="modal-division">
            <header>
              <p> Search in </p>
            </header>
            <div class="options">
              <label>
                <input type="checkbox" name="search_in_stories" value="yes" checked> Stories
              </label>
              <label>
                <input type="checkbox" name="search_in_comments" value="yes" checked> Comments
              </label>
            </div>
          </div> -->
          <div class="modal-division">
            <header>
              <p> Sort by </p>
            </header>
            <div class="options">
              <label>
                <input type="radio" name="sort_by" value="recent" <?php if(array_key_exists('sort_by', $GET)) echo 'checked'; ?>> Most recent
              </label>
              <label>
                <input type="radio" name="sort_by" value="upvoted"> Most upvoted
              </label>
              <label>
                <input type="radio" name="sort_by" value="comments"> Most comments
              </label>
            </div>
          </div>
          <div class="modal-division">
            <header>
              <p> Sort order </p>
            </header>
            <div class="options">
              <label>
                <input type="radio" name="sort_order" value="descending" checked> Descending
              </label>
              <label>
                <input type="radio" name="sort_order" value="ascending"> Ascending
              </label>
            </div>
          </div>
          <div class="modal-division">
            <header>
              <p> Search terms </p>
            </header>
            <div class="options">
              <input type="text" name="author_like" placeholder="author name">
              <input type="text" name="content_like" placeholder="search term">
            </div>
          </div>
          <input type="submit" value="Search" class="button button-blue button-block">
          <!-- <button class="button button-red button-block modal-close">Cancel</button> -->
      </form>
  </section>
  </div>

<?php }

function draw_modal_outer_background() {
/**
 * Draws the grey body background for when a modal is active.
 */ ?>
 <div id="modal-outer-background" class="no-display">
 </div>
 
<?php } ?>