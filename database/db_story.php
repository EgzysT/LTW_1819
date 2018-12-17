<?php
  include_once('../includes/database.php');

  /**
   * Returns all stories from the database that follow the restrictions
   * passed in the $options key-value array.
   * Possible keys: 
   *    subscribed_by => username
   */
  function getStories($options) {
    $db = Database::instance()->db();

    $query = 'SELECT 
    post.id, 
    story.title, 
    post.content, 
    post.upvotes_count, 
    post.downvotes_count, 
    (post.upvotes_count - post.downvotes_count) as points,
    channel.name as channel, 
    user.username as author_name, 
    user.profile_pic as profile_pic,
    post.posted_at as timestamp
    FROM story, post, channel, user WHERE ';
  
    $query = $query.'story.channel_id = channel.id AND story.post_id = post.id AND user.id = post.user_id AND post.content != "[deleted]" ';

    if(array_key_exists('subscribed_by', $options)) {
      $query = $query.'AND channel.id in (SELECT subscription.channel_id FROM subscription, user U WHERE subscription.user_id = U.id AND U.username = :subscribed_by) ';
    }

    if(array_key_exists('channel', $options)) {
      $query = $query.'AND channel.name = :channel ';
    }

    if(array_key_exists('author', $options)) {
      $query = $query.'AND user.username = :author ';
    }

    if(array_key_exists('author_like', $options)) {
      $query = $query.'AND user.username LIKE :author_like COLLATE NOCASE ';
    }

    if(array_key_exists('content_like', $options)) {
      $query = $query.'AND post.content LIKE :content_like COLLATE NOCASE ';
    }

    if(array_key_exists('sort_by', $options)) {
      if($options['sort_by'] === 'recent')
        $query = $query.' ORDER BY post.posted_at';        
      else if($options['sort_by'] === 'upvoted')
        $query = $query.' ORDER BY points';
      else if($options['sort_by'] === 'comments')
        $query = $query.' ORDER BY comments';
    }
    else 
      $query = $query.' ORDER BY post.posted_at';   
      
    if(array_key_exists('sort_order', $options)) {
      if($options['sort_order'] === 'ascending')
        $query = $query.' ASC';        
      else if($options['sort_order'] === 'descending')
        $query = $query.' DESC';
    }
    else 
      $query = $query.' DESC';   

    $stmt = $db->prepare($query);

    if(array_key_exists('channel', $options)) {
      $stmt->bindParam(':channel', $options['channel'], PDO::PARAM_STR);
    }

    if(array_key_exists('subscribed_by', $options)) {
      $stmt->bindParam(':subscribed_by', $options['subscribed_by'], PDO::PARAM_STR);
    }

    if(array_key_exists('author', $options)) {
      $stmt->bindParam(':author', $options['author'], PDO::PARAM_STR);
    }

    if(array_key_exists('author_like', $options)) {
      $author_temp = "%".$options['author_like']."%";
      $stmt->bindParam(':author_like', $author_temp, PDO::PARAM_STR);
    }

    if(array_key_exists('content_like', $options)) {
      $content_temp = "%".$options['content_like']."%";
      $stmt->bindParam(':content_like', $content_temp, PDO::PARAM_STR);
    }

    $stmt->execute();
    $stories = $stmt->fetchAll(PDO::FETCH_OBJ);


    foreach($stories as $story) {
      $story->posted_ago = time_ago($story->timestamp);
      $story->date = date("H:i:s d-m-y", $story->timestamp);
      
      $story->comments = countComments($story->id);
    }

    return $stories;
  }

  /**
   * Returns the story with the given id.
   */
  function getStory($post_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT 
    post.id,
    story.title, 
    post.content, 
    post.upvotes_count, 
    post.downvotes_count, 
    (post.upvotes_count - post.downvotes_count) as points,
    channel.name as channel, 
    user.username as author_name, 
    user.profile_pic as profile_pic,
    post.posted_at as timestamp,
    (SELECT count(*) FROM comment WHERE post.id = comment.parent_post) as comments
    FROM story, post, channel, user WHERE post.id = ? AND story.post_id = post.id AND post.user_id = user.id AND channel.id = story.channel_id');
    $stmt->execute(array($post_id));
    $story = $stmt->fetch(PDO::FETCH_OBJ);

    if(!$story) {
      return NULL;
    }

    $story->posted_ago = time_ago($story->timestamp);
    $story->date = date("H:i:s m-d-y", $story->timestamp);


    return $story;
  }

  /**
   * Creates a new story at the given channel.
   */
  function createStory($channel_name, $author_username, $story_title, $story_text) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO post (content, user_id)
    SELECT ?, user.id
    FROM user 
    WHERE user.username = ?');

    $stmt->execute(array($story_text, $author_username));
    $last_id = $db->lastInsertId();

    $stmt = $db->prepare('INSERT INTO story (title, channel_id, post_id) 
          SELECT ?, channel.id, ?
          FROM channel
          WHERE channel.name = ?');

    $stmt->execute(array($story_title, $last_id, $channel_name));
    
    return $last_id;
  }

  /**
   * Returns all the comments of a story
   */
  function getComments($post_id, $username) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT 
    post.id as id,
    post.content, 
    post.upvotes_count, 
    post.downvotes_count, 
    (post.upvotes_count - post.downvotes_count) as points,
    user.username as author_name, 
    post.posted_at as timestamp
    FROM comment, post, channel, user WHERE post.id= comment.post_id AND post.user_id = user.id AND comment.parent_post= ?  Group by post.id');
    $stmt->execute(array($post_id));
    $comments = $stmt->fetchAll(PDO::FETCH_OBJ);

    $stmt2 = $db->prepare('SELECT 
    vote_type FROM vote, user Where user.username = ? AND user.id = vote.user_id AND vote.post_id = ?');

    foreach($comments as $comment) {
      $stmt2->execute(array($username, $comment->id));
      $vote_type = $stmt2->fetch(PDO::FETCH_OBJ);

      if ($vote_type)
        $comment->vote_type = $vote_type->vote_type;

      $comment->posted_ago = time_ago($comment->timestamp);
      $comment->date = date("H:i:s m-d-y", $comment->timestamp);

      $comment->comments = getComments($comment->id, $username);
    }
    return $comments;
  }

  /**
   * Returns the total numbers of comments and subcomments of a post
   */
  function countComments($post_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT post_id From comment Where comment.parent_post= ?');
    $stmt->execute(array($post_id));
    
    $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
    $total_comments = 0;

    foreach($comments as $comment) {
      $total_comments += countComments($comment->post_id) + 1;
    }

    return $total_comments;
  }
  /**
   * Inserts a comment returning the comment just inserted
   */
  function insertComment($parent_post, $content, $username) {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare('INSERT INTO post (content, user_id)
    SELECT ?, user.id
    FROM user 
    WHERE user.username = ?');
    $stmt->execute(array($content, $username));
    $last_id = $db->lastInsertId();

    $stmt = $db->prepare('INSERT INTO comment VALUES (?, ?)');
    $stmt->execute(array($last_id, $parent_post));

    $stmt = $db->prepare('SELECT 
    post.id as id,
    post.content, 
    post.upvotes_count, 
    post.downvotes_count, 
    (post.upvotes_count - post.downvotes_count) as points,
    user.username as author_name, 
    post.posted_at as timestamp
    FROM comment, post, channel, user WHERE post.id= comment.post_id AND post.user_id = user.id AND comment.post_id= ?  Group by post.id');
    $stmt->execute(array($last_id));
    $comment = $stmt->fetch(PDO::FETCH_OBJ);

    $comment->posted_ago = time_ago($comment->timestamp);
    $comment->date = date("H:i:s d-m-y", $comment->timestamp);

    return $comment;

  
  }

  /* Helper Stuff */

  // Converts a datetime into a string like 'posted 5 minutes ago'.
  // @author https://www.sitepoint.com/counting-the-ago-time-how-to-keep-publish-dates-fresh/
  function time_ago( $time )
  {
      $TIMEBEFORE_NOW = 'now';
      $TIMEBEFORE_MINUTE = '{num} minute ago';
      $TIMEBEFORE_MINUTES = '{num} minutes ago';
      $TIMEBEFORE_HOUR = '{num} hour ago';
      $TIMEBEFORE_HOURS = '{num} hours ago';
      $TIMEBEFORE_YESTERDAY = 'yesterday';
      $TIMEBEFORE_FORMAT = '%d %b';
      $TIMEBEFORE_FORMAT_YEAR = '%d %b, %Y';

      $out    = ''; // what we will print out
      $now    = time(); // current time
      $diff   = $now - date($time); // difference between the current and the provided dates

      if( $diff < 60 ) // it happened now
          return $TIMEBEFORE_NOW;

      elseif( $diff < 3600 ) // it happened X minutes ago
          return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? $TIMEBEFORE_MINUTE : $TIMEBEFORE_MINUTES );

      elseif( $diff < 3600 * 24 ) // it happened X hours ago
          return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? $TIMEBEFORE_HOUR : $TIMEBEFORE_HOURS );

      elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
          return $TIMEBEFORE_YESTERDAY;

      else // falling back on a usual date format as it happened later than yesterday
        return strftime( date( 'Y', $time ) == date( 'Y' ) ? $TIMEBEFORE_FORMAT : $TIMEBEFORE_FORMAT_YEAR, $time );
  }

?>