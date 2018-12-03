<?php
  include_once('../includes/database.php');

  /**
   * Retrieves information about the channel with such name.
   */
  function get_channel_info($channel_name) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('SELECT channel.name, channel.description, channel.image
    FROM channel
    WHERE channel.name = ?');

    $stmt->execute(array($channel_name));

    $channel = $stmt->fetch(PDO::FETCH_OBJ);
    return $channel;
  }