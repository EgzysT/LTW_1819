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
    <article class="story-card">
        <header>
            <img class="author-avatar" src=<?=$story->profile_pic?> >
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
            <p class="sm-content"><?=$story->content?></p>
        </div>

        <footer>
            <div>
                <a class="read-more" href="./story.php?id=<?=$story->id?>">Read more</a>
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

    <section class="full-story-card">

        <article class="story-card">

            <header>
                <img class="author-avatar" src=<?=$story->profile_pic?> >
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
                <p class="lg-content"><?=$story->content?></p>
            </div>

             <div class="sc-aside">
                <p class="arrow-up" data-id="<?=$story->id?>"> <i class="fas fa-arrow-alt-circle-up"></i> </p>
                <p id="points"><?=$story->points?></p>
                <p class="arrow-down" data-id="<?=$story->id?>"> <i class="fas fa-arrow-alt-circle-down"></i> </p>
            </div>
        </article>

    </section>

<?php } ?>

<?php function draw_comment($comment) { 
    /**
     * Draws a big card for the story passed as an argument.
     * A card is simply a block that contains:
     *  - the author of the story (name and avatar),
     *  - the channel it was posted on,
     *  - the date it was created,
     *  - content (title and some text of the body),
     *  - the number of points and comments.
     */?>

    <article class="comment">

        <header>
            <img class="author-avatar" src=<?=$comment->profile_pic?> >
            <div class="info-left">
                <a href="./profile.php?user=<?=$comment->author_name?>" class="author-name"><?=$comment->author_name?></a>
                <p class="date" title="<?=$comment->date?>"><?=$comment->posted_ago?></p>
            </div>
        </header>

        <div class="body">
            <p class="lg-content"><?=$comment->content?></p>
        </div>

            <div class="sc-aside">
            <p class="arrow-up"> <i class="fas fa-arrow-alt-circle-up"></i> </p>
            <p id="points"><?=$comment->points?></p>
            <p class="arrow-down"> <i class="fas fa-arrow-alt-circle-down"></i> </p>
        </div>
    </article>

<?php } ?>