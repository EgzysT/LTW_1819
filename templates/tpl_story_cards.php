<?php function draw_story_cards($stories) { 
/**
 * Draws a section (#cards) containing several story cards
 * as articles. Uses the draw_story_card function to draw
 * each story card.
 */ ?>
    <section id="lists">

    <?php 
        foreach($stories as $story)
            draw_story_card($story);
    ?>

    </section>

<?php } ?>

<?php function draw_story_card($story) { 
/**
 * Draws the card for the story passed as an argument.
 * A card is simply a block that contains:
 *  - the author of the story (name and avatar),
 *  - the channel it was posted on,
 *  - the date it was created,
 *  - content (title and some text of the body),
 *  - 
 * the content (title and text) and the date it was created.
 */?>
    <article class="story-card">
        <header>
            <div class="story-card-info-left">
                <img class="story-card-author-avatar">
                <p class="story-card-author-name"><?=$story->author_name?></p>
                <p class="story-card-date"><?=$story->date?></p>
            </div>
            <div class="story-card-info-right">
                <p class="story-card-channel"><?=$story->channel?></p>
            </div>
        </header>

        <div class="story-card-body">
            <h2 class="story-card-title"><?=$story->title?></h2>
            <p class="story-card-content"><?=$story->content?></p>
            <a class="story-card-read-more" href="#">Read more</a>
        </div>

        <footer>
            <ul class="story-card-footer-list">
                <li><p><?=$story->points?> Points</p>
                <li><p><?=$story->comments?> Comments</li>
            </ul>
        </footer>
    </article>

<?php } ?>