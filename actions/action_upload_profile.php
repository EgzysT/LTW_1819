<?php
	include_once('../includes/session.php');
  include_once('../database/db_user.php');

	//Bio Text area
	$username = $_SESSION['username'];
	if(isset($_POST["submit"])) {
		updateUserBio($username, $_POST["bio"]);
	}



	//Profile Image Upload
	$target_dir = "../assets/profile_pics/";
	$uniquename = time().uniqid(rand(), true);	// DOES NOT GUARENTEE UNIQUENESS, but it is pratically impossible to get it to match.
	$temp_file = $target_dir . basename($_FILES["newProfilePic"]["name"]);
	$target_file = $target_dir . $uniquename;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($temp_file,PATHINFO_EXTENSION));
	$target_file = $target_file . "." . $imageFileType;

	if(isset($_POST["submit"])) {
		//check if any file was uploaded
		if(!file_exists($_FILES['newProfilePic']['tmp_name']) || !is_uploaded_file($_FILES['newProfilePic']['tmp_name'])) {
			echo 'No file upload';
			die(header('Location: ../pages/edit_profile.php'));
		}
		else {
			//check if file is an image
			$check = getimagesize($_FILES["newProfilePic"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}

			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists, you won the jackpot of bad luck!.";
				$uploadOk = 0;
			}

			// Check file size
			if ($_FILES["newProfilePic"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["newProfilePic"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["newProfilePic"]["name"]). " has been uploaded.";
					updateUserPicPath($username, $target_file);
					die(header('Location: ../pages/edit_profile.php'));
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
		}
	}	
?>