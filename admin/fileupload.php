<html>
<head>
	<title>Administrator - File Upload Complete</title>
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
</head>
<body>
<br />
<a href="../admin/fileuploadform.php">Click here to upload another file</a><br />
<?php
include ('config.php');
include ('session.php');
if (ADMIN_ID === 0){
	header('Location: ./home.php');
}
else 
{
//check form input

echo $_POST["title"]."<br />";
echo $_POST["desc"]."<br />";
echo $_POST["title"]."<br />";
echo $_POST["category_id"]."<br />";
echo $_POST["author_id"]."<br />";
echo $_POST["publisher_id"]."<br />";
echo $_POST["isbn"]."<br />";
echo $_POST["publish_year"]."<br />";
echo $_POST["start_year"]."<br />";
echo $_POST["end_year"]."<br />";
echo $_POST["volume"]."<br />";
echo $_POST["availability_id"]."<br />";
echo $_POST["url"]."<br />";

 $keywordIDList;
$availability_id = $_POST["availability_id"];
/* foreach ($_POST['keyword'] as $keywords)
    {
            $keywordIDList += $keywords." ";
    } */
/* $keywords = $_POST['keywords'];
print_r ($keywords);
echo "keywords ".$keywords."<br />";	 */
/* 
foreach ($_POST['keyword'] as $keyword)
    {
            print "Selected keyword id is $keyword<br/>";
    }
 */
if($availability_id == 0 || $availability_id == 2){
$uploadOk = 1;
echo $_FILES["fileToUpload"]["name"];

//start upload script
//define MB constant
define('MB', 1048576);

//PHP upload script
$target_dir = "./uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
$file = $_FILES['fileToUpload'];
//$fileUploadName = $file['name'];
$fileUploadName = $_FILES["fileToUpload"]["name"];
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
	else 
	{
	//echo "lets start actual upload";

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."."<br />";
	}	
}
}
		

		$availability_id = mysqli_real_escape_string($conn, htmlspecialchars($_REQUEST['availability_id']));
		$category_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category_id']));
		$author_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['author_id']));
		$publisher_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publisher_id']));
		$title = mysqli_real_escape_string($conn, htmlspecialchars($_REQUEST['title']));
		$description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['desc']));
		$isbn = mysqli_real_escape_string($conn, htmlspecialchars($_POST['isbn']));
		$publish_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publish_year']));
		$start_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['start_year']));
		$end_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['end_year']));
		$volume = mysqli_real_escape_string($conn, htmlspecialchars($_POST['volume']));
		
		
		//echo $availability_id." ".$category_id." ".$author_id." ".$publisher_id." ".$title." ".$description." ".$isbn." ".$publish_year." ".$start_year." ".$end_year." ".$volume." ".$url."<br />";
		
		$sql = "INSERT INTO amphrc_library.publications (category_id,title, description, isbn ,publish_year ,start_year ,end_year ,volume ,availability_id ) 
		VALUES ('$category_id','$title','$description','$isbn',$publish_year ,$start_year ,$end_year ,'$volume' , $availability_id)";
		
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			echo "New record created successfully. Last inserted ID is: " . $last_id;
			
			$sql1 = "INSERT INTO amphrc_library.publication_author (publication_id, author_id) VALUES ($last_id, $author_id)";
			if ($conn->query($sql1) === TRUE) {
				echo "<br />entry to publication_author made";
				}
			$sql2 = "INSERT INTO amphrc_library.publication_publisher (publication_id, publisher_id) VALUES ($last_id, $publisher_id)";
			if ($conn->query($sql2) === TRUE) {
				echo "<br />entry to publication_publisher made";
				$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Added a new publication with id $last_id')";
				if(mysqli_query($conn, $sql_log)){}
				}
			foreach ($_POST['keyword'] as $keyword){ 
				//print "Selected keyword id is $keyword<br/>"; 
				$sql_keyword = "INSERT INTO amphrc_library.publication_keyword (publication_id, keyword_id) VALUES ($last_id, $keyword)";
				if(mysqli_query($conn, $sql_keyword)){
					echo "entry made for $keyword <br />";
				}
			}
			if ($availability_id == 3){
				$url = mysqli_real_escape_string($conn, htmlspecialchars($_POST['url'])); 
				$sql3 = "INSERT INTO amphrc_library.url (url, publication_id) values ('$url', $last_id)";
				//echo $sql3."<br />";
				if ($conn->query($sql3) === TRUE) {
				echo "<br />entry to url made";
				$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Added a new url for publication id $last_id')";
				if(mysqli_query($conn, $sql_log)){}
			}
			}
			if ($availability_id == 0 || $availability_id == 2){
				$url = mysqli_real_escape_string($conn, htmlspecialchars($_POST['url'])); 
				$sql3 = "INSERT INTO amphrc_library.file_location (file_location, publication_id) values ( '$path', $last_id)";
				if ($conn->query($sql3) === TRUE) {
				echo "<br />entry to url made";
				echo $sql3."<br />";
				$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Added a new url with id $last_id')";
				if(mysqli_query($conn, $sql_log)){}
				}
			}
		header('Location: ./fileuploadform.php');
 	
$conn->close();
}	
}	
?>
</body>
</html>