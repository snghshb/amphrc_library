<?php

//this file deals with file upload and making this entry into the repository table

//first part deals with file upload
define('MB', 1048576);

$target_dir = "uploads/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

/* Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/

// Check if file already exists
if (file_exists($target_file)) {
    echo "\n"."Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50*MB) {
    echo "\n"."Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx"
&& $imageFileType != "jpg" && $imageFileType != "png") {
    echo "\n"."Sorry, only PDF, DOC, DOCXm JPG and PNG files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "\n"."Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "\n"."The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "\n"."Sorry, there was an error uploading your file.";
		}
	}


	
//first part ends
	
//database entry starts
//run this part only if the file was successfully uploaded

if($uploadOk == 0)	{
	echo "\n"."Sorry, the file was not uploaded. New database entry not created";
}
else
{
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "librarydummy";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error)	{
		die("Connection failed: ".$conn->connect_error);
	}
	
		$sql ="INSERT INTO repository (name, tag, attachment)
	values ('" . $_POST['fileName'] . "' , '" .$_POST['tags'] . "','fileWasAttached')";
	
	if (mysqli_query($conn, $sql)) {
		echo "\n"."New record created successfully";
	} else {
		echo "\n"."Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	mysqli_close($conn);
	
	echo "\n"."Sorry, the file was not uploaded. New database entry not created";

}
//*/


	echo "<button onclick=\"history.go(-1);\">Back </button>";


	?>