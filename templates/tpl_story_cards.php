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
    <article class="card">
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

<?php function draw_full_story_card($story, $vote_type) { 
    /**
     * Draws a big card for the story passed as an argument.
     * A card is simply a block that contains:
     *  - the author of the story (name and avatar),
     *  - the channel it was posted on,
     *  - the date it was created,
     *  - content (title and some text of the body),
     *  - the number of points and comments.
     */?>

    <article id="full-story" class="card">

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
            
            <?php if($_SESSION['username']){ ?>
                <p class="arrow-up"> <i data-id="<?=$story->id?>" class="fas fa-arrow-alt-circle-up <?php if($vote_type === 'u') echo 'selected'; ?>"></i> </p>
            <?php } ?>        
                <p id="points"><?=$story->points?></p>
            <?php if($_SESSION['username']){ ?>   
                <p class="arrow-down"> <i data-id="<?=$story->id?>" class="fas fa-arrow-alt-circle-down <?php if($vote_type === 'd') echo 'selected'; ?>"></i> </p>
            <?php } ?>        
                
            </div>
    </article>

<?php } ?>

<?php function draw_comments($comments, $parent_post) { 
    /**
     * Draws a section (comments) containingall the comments passed as argument
     */?>

    <section id="comments">
        <?php 

            // if the user is loged in draws the comment form
            if($_SESSION['username'])
                draw_comment_form($parent_post);

            foreach($comments as $comment)
                draw_comment($comment);
        ?>
    </section>
<?php } ?>

<?php function draw_comment($comment) { 
    /**
     * Draws a big card for the story passed as an argument.
     * A card is simply a block that contains:
     *  - the author's name of the comment
     *  - the date it was created,
     *  - content
     *  - the number of points
     */?>

    <article class="comment">

        <header>
            <a href="./profile.php?user=<?=$comment->author_name?>" class="author-name"><?=$comment->author_name?></a>
            <p class="date" title="<?=$comment->date?>"><?=$comment->posted_ago?></p>
            <p class="points"><?=$comment->points?></p>
            <p>points</p>

        <?php if($_SESSION['username']){ ?>
            <div class="reply" data-id="<?=$comment->id?>">
                <i class="far fa-comment-alt"></i>
                <p>reply</p>
            </div>

            <div class="arrows">
                <p class="arrow-up"> <i data-id="<?=$comment->id?>" class="fas fa-arrow-alt-circle-up <?php if($comment->vote_type === 'u') echo 'selected'; ?>"></i> </p>
                <p class="arrow-down"> <i data-id="<?=$comment->id?>" class="fas fa-arrow-alt-circle-down <?php if($comment->vote_type === 'd') echo 'selected'; ?>"></i> </p>
            </div>
        <?php } ?>
        </header>

        <div class="body">
            <p class="lg-content"><?=$comment->content?></p>
        </div>

        <div class="reply-form" >
            <?php
                draw_comment_form($comment->id);
            ?>
        </div>
        
        <div class="subcomments">
            <?php 
                foreach($comment->comments as $subcomment)
                    draw_comment($subcomment);
            ?>
        </div>

    </article>

<?php } ?>

<?php function draw_comment_form($parent_post) { 
    ?>

    <form method="post" data-id="<?=$parent_post?>" action="../actions/action_comment.php" class="comment-form" >
        <input class="content" type="text-area" name="content" placeholder="What are your thoughts?" required>
        <input class="button button-blue button-block" type="submit" value="Comment" >
    </form>

<?php } ?>