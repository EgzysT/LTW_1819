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

  /**
   * Unsubscribe user to channel.
   */
  function unsubscribe($username, $channel_name) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('DELETE FROM subscription
    WHERE subscription.channel_id in (
    SELECT channel.id
    FROM channel
    WHERE channel.name = ?)
    AND subscription.user_id in (
    SELECT user.id
    FROM user
    WHERE user.username = ?)');

    $stmt->execute(array($channel_name, $username));
  };

  /**
   * Subscribe user to channel.
   */
  function subscribe($username, $channel_name) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO subscription (user_id, channel_id)
    SELECT user.id, channel.id
    FROM channel, user 
    WHERE channel.name = ? AND user.username = ?');

    $stmt->execute(array($channel_name, $username));
  };

  /**
   * Subscribe user to channel.
   */
  function get_all_channels() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT channel.id, channel.name, channel.image
    FROM channel
    ORDER BY channel.name');

    $stmt->execute();

    $subscribed_channels = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $subscribed_channels;
  };
?>