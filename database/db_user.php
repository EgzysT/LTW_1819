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

  function insertUser($username, $email, $password) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('INSERT INTO user (username, password, email) VALUES (?, ?, ?)');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options), $email));
  }

  function fetchProfilePicURL($username) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT profile_pic FROM user WHERE username = ?');
    $stmt->execute(array($username));

    $profile_pic = $stmt->fetch();
    return $profile_pic;
  }

  function fetchBio($username) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT bio FROM user WHERE username = ?');
    $stmt->execute(array($username));

    $bio = $stmt->fetch();
    return $bio;
  }
?>