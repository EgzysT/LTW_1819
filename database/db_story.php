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
    post.posted_at as timestamp,
    (SELECT count(*) FROM comment WHERE post.id = comment.post_id) as comments
    FROM story, post, channel, user WHERE ';
  
    $query = $query.'story.channel_id = channel.id AND story.post_id = post.id AND user.id = post.user_id ';

    if(array_key_exists('subscribed_by', $options)) {
      $query = $query.'AND channel.id in (SELECT subscription.channel_id FROM subscription, user U WHERE subscription.user_id = U.id AND U.username = :subscribed_by) ';
    }

    if(array_key_exists('channel', $options)) {
      $query = $query.'AND channel.name = :channel';
    }

    if(array_key_exists('author', $options)) {
      $query = $query.'AND user.username = :author';
    }

    $query = $query.' ORDER BY post.posted_at DESC';

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

    $stmt->execute();
    $stories = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach($stories as $story) {
      $story->posted_ago = time_ago($story->timestamp);
      $story->date = date("H:i:s m-d-y", $story->timestamp);
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
    post.posted_at as timestamp,
    (SELECT count(*) FROM comment WHERE post.id = comment.post_id) as comments
    FROM story, post, channel, user WHERE post.id= ?');
    $stmt->execute(array($post_id));
    $story = $stmt->fetch(PDO::FETCH_OBJ);

    $story->posted_ago = time_ago($story->timestamp);
    $story->date = date("H:i:s m-d-y", $story->timestamp);


    return $story;
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
      $TIMEBEFORE_FORMAT = '%e %b';
      $TIMEBEFORE_FORMAT_YEAR = '%e %b, %Y';

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