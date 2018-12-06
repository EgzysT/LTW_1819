<?php
  include_once('../includes/database.php');

  /**
   * Removes all votes from the database for the given user and the given post/story.
   */
   function clear_vote($username, $post_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('DELETE FROM vote
    WHERE post_id = ? AND 
          user_id in (
    SELECT user.id
    FROM user
    WHERE user.username = ?)');

    $stmt->execute(array($post_id, $username));
   }

   /**
   * Inserts an upvote for the user for the given post
   */
   function upvote($username, $post_id) {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare('INSERT INTO vote (vote_type, post_id, user_id)
    SELECT "u", ?, user.id
    FROM user 
    WHERE user.username = ?');

    $stmt->execute(array($post_id, $username));
   }

   /**
   * Inserts a downvote for the user for the given post
   */
  function downvote($username, $post_id) {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare('INSERT INTO vote (vote_type, post_id, user_id)
    SELECT "d", ?, user.id
    FROM user 
    WHERE user.username = ?');

    $stmt->execute(array($post_id, $username));
  }

  /**
   * Gets the vote of a user for the given post. Can be 'u', 'd' or null.
   */
  function get_vote($username, $post_id) { 
    $db = Database::instance()->db();
    
    $stmt = $db->prepare('SELECT user_id,
    vote_type
    FROM vote
    WHERE post_id = ? AND 
    user_id in (
    SELECT user.id
    FROM user
    WHERE user.username = ?)');

    $stmt->execute(array($post_id, $username));

    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if($result)
      return $result->vote_type;
    else 
      return NULL;

  }
    

?>