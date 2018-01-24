<html>
<head>
	<title>Administrator - Sample Upload Complete</title>
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
</head>
<body>
<br />
<a href="../admin/editSampleForm.php">Click here to upload another sample</a><br />
<?php
include ('session.php');
include ('config.php');

//echo $_POST["publication_id"]."<br />";
//echo $_FILES["sampleToUpload"]["name"];
$uploadOk = 1;
//echo $_FILES["sampleToUpload"]["name"];

//start upload script
//define MB constant
define('MB', 1048576);

//PHP upload script
$target_dir = "./sample/";
$target_file = $target_dir . basename($_FILES["sampleToUpload"]["name"]);

$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
$file = $_FILES['sampleToUpload'];
$fileUploadName = $file['name'];

$path = "/sample/" . basename($fileUploadName);
//echo $path."<br />";

//check if file already exists
if (file_exists($target_file)) {
  //  echo "Sorry, file already exists."."<br />";
    $uploadOk = 0;
		header('Location: ./editSampleForm.php');

		}

//Check file size
if ($_FILES["sampleToUpload"]["size"] > 5*MB) {
//    echo "Sorry, your file is too large."."<br />";
    $uploadOk = 0;
			header('Location: ./editSampleForm.php');

}

// limit to certain file type
if($fileType != "pdf" && $fileType != "PDF" && $fileType != "jpeg"  && $fileType != "jpg" && $fileType != "png") {
//    echo "Sorry, only PDF, PNG, JPEG, JPG files are allowed."."<br />";
    $uploadOk = 0;
			header('Location: ./editSampleForm.php');

}
else 
	{
	//echo "lets start actual upload"."<br />";
	if (move_uploaded_file($_FILES["sampleToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["sampleToUpload"]["name"]). " has been uploaded."."<br />";
	}	
	
	$publication_id = mysqli_real_escape_string($conn, htmlspecialchars($_REQUEST['publication_id']));
	//echo $publication_id;
	$sql = "INSERT INTO amphrc_library.publication_sample (publication_id, sample_location) VALUES ($publication_id, '$path')";
	
	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		//echo "something";
		$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Inserted a new sample $last_id')";
	if(mysqli_query($conn, $sql_log)){
		//echo "something else";
	header('Location: ./editSampleForm.php');


	}
		
}
	}
?>

</body>
</html>