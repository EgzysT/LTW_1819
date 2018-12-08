<?php
  include_once('../includes/session.php');
  include_once('../database/db_channel.php');

  $username = $_SESSION['username'];
  if(!$username)
    exit(0);
  
  $channel_name = strtolower($_POST['channel_name']);
  $channel_desc = $_POST['channel_description'];

  if(strlen($_FILES['image']['tmp_name']) === 0)
    die('No channel image uploaded.');

  if(!isset($channel_name) || strlen($channel_name) > 8) {
    die('Channel name must be less than 8 characters.');
  }

  if(!isset($channel_desc) || strlen($channel_desc) > 100) {
    die('Channel description must be less than 100 characters.');
  }

  // Handle image stuff;
  $original_img = imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name']));
  if(!$original_img) { 
    die('Image extension not supported.');
  }

  $width = imagesx($original_img);     // width of the original image
  $height = imagesy($original_img);    // height of the original image

  $small = imagecreatetruecolor(572, 400);
  imagecopyresized($small, $original_img, 0, 0, 0, 0, 572, 400, $width, $height);
  imagejpeg($small, "../assets/channels/$channel_name.jpg");

  create_channel($channel_name, $channel_desc);
  subscribe($username, $channel_name);
  die('ok');
?>