<?php function draw_story_cards($stories) { 
/**
 * Draws a section (#stories) containing several story cards
 * as articles. Uses the draw_story_card function to draw
 * each story card.
 */ ?>
    <section id="stories">

    <?php 
        foreach($stories as $story)
            draw_small_story_card($story);
    ?>

    </section>

<?php } ?>

<?php function draw_small_story_card($story) { 
/**
 * Draws a small card for the story passed as an argument.
 * A card is simply a block that contains:
 *  - the author of the story (name and avatar),
 *  - the channel it was posted on,
 *  - the date it was created,
 *  - content (title and some text of the body),
 *  - the number of points and comments.
 */?>
    <article class="sm-story-card">
        <header>
            <img class="author-avatar" src="../assets/main_aside.jpg">
            <div class="info-left">
                <a href="./profile.php?user=<?=$story->author_name?>" class="author-name"><?=$story->author_name?></a>
                <p class="date" title="<?=$story->date?>"><?=$story->posted_ago?></p>
            </div>
            <div class="info-right">
                <a href="./channel.php?name=<?=$story->channel?>" class="sc_channel">#<?=$story->channel?></a>
            </div>
        </header>

        <div class="body">
            <h2 class="title"><?=$story->title?></h2>
            <p class="content"><?=$story->content?></p>
        </div>

        <footer>
            <div>
                <a class="read-more" href="#">Read more</a>
            </div>
            <ul>
                <li><p><?=$story->points?> Points</p>
                <li><p><?=$story->comments?> Comments</li>
            </ul>
        </footer>
    </article>

<?php } ?>

<?php function draw_full_story_card($story) { 
/**
 * Draws a big card for the story passed as an argument.
 * A card is simply a block that contains:
 *  - the author of the story (name and avatar),
 *  - the channel it was posted on,
 *  - the date it was created,
 *  - content (title and some text of the body),
 *  - the number of points and comments.
 */?>
    <article class="full-story-card">
        <div class="sc-aside">
            <p class="arrow-up"> <i class="fas fa-arrow-alt-circle-up"></i> </p>
            <p><?=$story->points?></p>
            <p class="arrow-down"> <i class="fas fa-arrow-alt-circle-down"></i> </p>
        </div>

        <div class="story-card">

            <header>
                <div class="info-left">
                    <img class="author-avatar" src="../assets/main_aside.jpg">
                    <p class="author-name"><?=$story->author_name?></p>
                    <p class="date"><?=$story->date?></p>
                </div>
                <div class="info-right">
                    <p class="sc_channel"><?=$story->channel?></p>
                </div>
            </header>

            <div class="body">
                <h2 class="title"><?=$story->title?></h2>
                <p class="content"><?=$story->content?></p>
            </div>
        </div>

    </article>

<?php } ?>