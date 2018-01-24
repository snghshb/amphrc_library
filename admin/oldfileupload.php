<?php
//code for file upload

define('MB', 1048576);

//PHP upload script

$target_dir = "./uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
$file = $_FILES['fileToUpload'];
$fileUploadName = $file['name'];

//echo $file."<br />".$fileUploadName."<br />";

$path = "/uploads/" . basename($fileUploadName);

echo $path."<br />";

//check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

//Check file size
if ($_FILES["fileToUpload"]["size"] > 50*MB) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// limit to certain file type
if($fileType != "docx" && $fileType != "doc" && $fileType != "pdf" && $fileType != "PDF" && $fileType != "jpeg"  && $fileType != "jpg" && $fileType != "png") {
    echo "Sorry, only PDF, DOC, DOCX, PNG, JPEG, JPG files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
	else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."."<br />";
		
		//once upload successful, make database entry as well.
		
		//echo $_POST["fileName"];
		//echo $_POST["fileTags"];
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "amphrc_library";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		$category_id = mysqli_real_escape_string($conn, $_REQUEST['category_id']);
		$title = mysqli_real_escape_string($conn, $_REQUEST['fileTitle']);
		$description = mysqli_real_escape_string($conn, $_REQUEST['description']);
		$isbn = mysqli_real_escape_string($conn, $_REQUEST['isbn']);
		$publish_year = mysqli_real_escape_string($conn, $_REQUEST['publish_year']);
		$start_year = mysqli_real_escape_string($conn, $_REQUEST['start_year']);
		$end_year = mysqli_real_escape_string($conn, $_REQUEST['end_year']);
		$volume = mysqli_real_escape_string($conn, $_REQUEST['volume']);
		$availability_id = mysqli_real_escape_string($conn, $_REQUEST['availability_id']);
		$author_id= mysqli_real_escape_string($conn, $_REQUEST['author_id']);
		
		if($conn->connect_error)	{
		die("Connection failed: ".$conn->connect_error);
		}
		
		//$sql = "INSERT INTO publications (title, description, availability_id) VALUES ('name','desc', 1)";
		
		$sql = "INSERT INTO publications (category_id,title, description, isbn ,publish_year ,start_year ,end_year ,volume ,availability_id ) 
		VALUES ('$category_id','$title','$description','$isbn',$publish_year ,$start_year ,$end_year ,'$volume' , $availability_id)";
		
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			echo "New record created successfully. Last inserted ID is: " . $last_id;
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}	
		
		//$pathFinal = mysqli_real_escape_string($path);
		
		//echo $path."<br />".$pathFinal."<br />";
		
		$sql1 = "INSERT INTO file_location (file_location, publication_id) 
		VALUES ('$path', $last_id)";
	
		if(mysqli_query($conn, $sql1)){
			echo "file location stored using $sql1";//Records added successfully.";
			} else{
				echo "ERROR: Could not able to execute $sql1. " . mysqli_error($conn)."<br />";
				}
				
        $sql2 = "INSERT INTO publication_author (publication_id,author_id) 
		VALUES ($last_id,$author_id)";
	
		 if(mysqli_query($conn, $sql2)){
			echo "author details stored using $sql2";//Records added successfully.";
			} else{
				echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn)."<br />";
				} 
        
		// close connection
		mysqli_close($conn);
	
	} 
	else {
        echo "Sorry, there was an error uploading your file."."<br />";
    }
}
?>