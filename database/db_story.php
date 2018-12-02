<?php
  include_once('../includes/database.php');

  /**
   * Returns all stories from the database that follow the restrictions
   * passed in the $options key-value array.
   */
  function getStories($options) {
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
        post.posted_at as date,
        (SELECT count(*) FROM comment WHERE post.id = comment.post_id) as comments
      FROM story, post, channel, user
      WHERE story.channel_id = channel.id AND story.post_id = post.id AND user.id = post.user_id');
    $stmt->execute(array());
    $stories = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $stories;
  }

  /**
   * Returns the story with the given id.
   */
  function getStory($id) {
    $db = Database::instance()->db();
    //$stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    //$stmt->execute(array($username));
    //$user = $stmt->fetch();
  }

?>