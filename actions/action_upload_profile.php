<?php

//Bio Text area
if(isset($_POST["submit"])) {
	updateUserBio($username, $_POST["bio"]);
}

//Profile Image Upload
$target_dir = "../assets/profile_pics/";
$target_file = $target_dir . basename($_FILES["newProfilePic"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["newProfilePic"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
}

if(!file_exists($_FILES['newProfilePic']['tmp_name']) || !is_uploaded_file($_FILES['newProfilePic']['tmp_name'])) {
    echo 'No file upload';
}
else {

	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
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
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}

?>