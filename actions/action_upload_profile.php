<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  // Validate csrf
  if($_SESSION['csrf'] !== $_POST['csrf'])
    die('Invalid csrf');
    
	//Bio Text area
  $username = $_SESSION['username'];
  updateUserBio($username, $_POST["bio"]);
	if(!file_exists($_FILES['newProfilePic']['tmp_name']) || !is_uploaded_file($_FILES['newProfilePic']['tmp_name'])) {
    die('ok');
	}

	//Profile Image Upload
	$target_dir = "../assets/profile_pics/";
	$uniquename = time().uniqid(rand(), true);	// DOES NOT GUARENTEE UNIQUENESS, but it is pratically impossible to get it to match.
	$temp_file = $target_dir . basename($_FILES["newProfilePic"]["name"]);
	$target_file = $target_dir . $uniquename;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($temp_file,PATHINFO_EXTENSION));
	$target_file = $target_file . ".jpg";

  //check if file is an image
  $check = getimagesize($_FILES["newProfilePic"]["tmp_name"]);
  if($check === false) {
    die("File uploaded is not a image");
  } else {
    $uploadOk = 1;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    $target_file = $target_file . strval(rand(1,10000)) .".jpg";
  }

  // Check file size
  if ($_FILES["newProfilePic"]["size"] > 500000) {
    die("Sorry, your file is too large.");
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    die("Try again.");
  // if everything is ok, try to upload file
  } else {
    $original = @imagecreatefromstring(file_get_contents($_FILES['newProfilePic']['tmp_name']));
    $width = imagesx($original);
    $height = imagesy($original);
    $maxSize = min($width, $height);
    $squaredImg = imagecreatetruecolor($maxSize, $maxSize);
    imagecopyresized($squaredImg, $original, 0, 0, ($width>$maxSize)?($width-$maxSize)/2:0, ($height>$maxSize)?($height-$maxSize)/2:0, $maxSize, $maxSize, $maxSize, $maxSize);
    imagejpeg($squaredImg, $target_file);
    updateUserPicPath($username, $target_file);
    die('ok');
  }
?>