<?php function draw_story_cards($stories) { 
/**
 * Draws a section (#stories) containing several story cards
 * as articles. Uses the draw_story_card function to draw
 * each story card.
 */ ?>
    <section id="stories">

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
            <img class="author-avatar" src="../assets/main_aside.jpg">
            <div class="info-left">
                <p class="author-name"><?=$story->author_name?></p>
                <p class="date" title="<?=$story->date?>"><?=$story->posted_ago?></p>
            </div>
            <div class="info-right">
                <a href="./channel.php?name=<?=$story->channel?>" class="sc_channel">#<?=$story->channel?></a>
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