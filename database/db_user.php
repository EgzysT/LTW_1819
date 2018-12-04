<?php
  include_once('../includes/database.php');

  /**
   * Verifies if a certain username, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function checkUserPassword($username, $password) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));

    $user = $stmt->fetch();
    return $user !== false && password_verify($password, $user['password']);
  }

  /**
   * Inserts a new user into the database.
   */
  function insertUser($username, $email, $password) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('INSERT INTO user (username, password, email) VALUES (?, ?, ?)');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options), $email));
  }

  /**
   * Gets subscribed channels for the given user.
   */
  function getSubscribedChannels($username) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('SELECT channel.id, channel.name, channel.image
    FROM user, subscription, channel
    WHERE user.username = ? AND subscription.user_id = user.id AND subscription.channel_id = channel.id
    ORDER BY channel.name');

    $stmt->execute(array($username));

    $subscribed_channels = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $subscribed_channels;
  }

  function getUserProfile($username) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT user.profile_pic, user.bio, user.points FROM user WHERE username = ?');
    $stmt->execute(array($username));

    $user_profile = $stmt->fetch(PDO::FETCH_OBJ);
    return $user_profile;
  }
?>