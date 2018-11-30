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
 *  - the number of points and comments.
 */?>
    <article class="story-card">
        <header>
            <div class="info-left">
                <img class="author-avatar">
                <p class="author-name"><?=$story->author_name?></p>
                <p class="date"><?=$story->date?></p>
            </div>
            <div class="info-right">
                <p class="channel"><?=$story->channel?></p>
            </div>
        </header>

        <div class="body">
            <h2 class="title"><?=$story->title?></h2>
            <p class="content"><?=$story->content?></p>
            <a class="read-more" href="#">Read more</a>
        </div>

        <footer>
            <ul>
                <li><p><?=$story->points?> Points</p>
                <li><p><?=$story->comments?> Comments</li>
            </ul>
        </footer>
    </article>

<?php } ?>