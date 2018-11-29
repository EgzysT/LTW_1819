<?php
  include_once('../includes/database.php');

  /**
   * Returns all stories from the database that follow the restrictions
   * passed in the $options key-value array.
   */
  function getStories($options) {
    $db = Database::instance()->db();
    //$stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    //$stmt->execute(array($username));
    //$user = $stmt->fetch();
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