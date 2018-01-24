<?php

	//function renderForm($publication_id, $publication_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	
	function renderForm($publication_id, $url, $file_location, $error)
	{

		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--meta http-equiv="X-UA-Compatible" content="IE=edge"-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">
	<!--link rel="stylesheet" href="../css/bootstrap.css"-->
	<link rel="stylesheet" href="../css/custom.css">
	<title>Administrator - Edit Category</title>
	<script> 
    $(function(){
      $("#includeHeader").load("header.html"); 
    });
    </script>
	<script> 
    $(function(){
      $("#includeNavbar").load("navbar.html"); 
    });
    </script>
	<script> 
    $(function(){
      $("#includeFooter").load("footer.html"); 
    });
    </script>
</head>
<body>
<div class="wrapper">
<div id="includeHeader"></div>
<div id="includeNavbar"></div>
<div class="content" align="center">
	<table border="0px" width="80%" height="400px" class="marginTable">
	<tr>
	<td valign="top">
	<h3>Edit Availability for file <?php echo $publication_id;?></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

?>
							<form name = "f1" action="" method="post" enctype="multipart/form-data">
<script language="JavaScript">
function load(){
	codename();
}
window.onload=load;
window.codename = function () {
		console.log(document.getElementById("availability_id").value);
		if (document.getElementById("availability_id").value == "0"){
			document.getElementById("url").disabled = "disabled";
			document.getElementById("fileToUpload").disabled = "";
		}else if(document.getElementById("availability_id").value == "1"){
			document.getElementById("url").disabled = "disabled";
			document.getElementById("fileToUpload").disabled = "disabled";
		}else if(document.getElementById("availability_id").value == "2"){
			document.getElementById("url").disabled = "disabled";
			document.getElementById("fileToUpload").disabled = "";
		}else if(document.getElementById("availability_id").value == "3"){
			document.getElementById("url").disabled = "";
			document.getElementById("fileToUpload").disabled = "disabled";
		} else {
			
		document.getElementById("url").disabled = "";
		}
		return true;
}
</script>
							<input type="hidden" name="publication_id" value="<?php echo $publication_id; ?>"/>
								<table>							
								<tr>
								<td>Publication ID</td>
								<td><?php echo $publication_id;?></td>
								</tr>
								<tr>
								<td>Select Availability</td>
								<td><select name = "availability_id" id = "availability_id" onchange="codename()">
									<option value = '0'>0: Uploading File to Online Library Only</option>
									<option value = '1'>1: Available Only On-premise Library</option>
									<option value = '2'>2: Uploading File and Available On-premise</option>
									<option value = '3'>3: Available at Partner Website</option>
								</select></td>
								</tr>
								<tr>
								<td>Partner Database URL</td>
								<td><input type="text" name="url" id = "url" value="<?php echo $url; ?>" /></td>
								</tr>
								<tr>
								<td>Current File</td>
								<td><?php echo $file_location ?></td>
								</tr>
								<tr>
								<td>Upload File</td>
								<td><input type="file" name="fileToUpload" id="fileToUpload">
								<br /><p class="footnote">Allowed file types are PDF, DOC, DOCX, JPG, JPEG, PNGs</p>
								</td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Record" name="submit"></td>
								</tr>
								</table>
						</form>
				</td>
					</tr>
				</table>
			</div>
<div id="includeFooter"></div>
</div>
</body>
</html>

<?php

	}
	

	include("config.php");
	
	// check if the form has been submitted. If it has, process the form and save it to the database
	$publication_id = '';
	$error = '';
	$url = '';
	$file_location = 'No File Uploaded';
	
	
	if (isset($_POST['submit']))
	{
	$uploadOk = 1;
		// confirm that the 'id' value is a valid integer before getting the form data
		if (is_numeric($_POST['publication_id']))
		{
			// get form data, making sure it is valid
			//$publication_id = $_POST['publication_id'];
			$publication_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publication_id']));
			$availability_id = $_POST['availability_id'];
			if(isset($_POST['url'])){
				$url = $_POST['url'];
			}
			if($availability_id == 0 && empty($_FILES['fileToUpload']['name'])){
				$error = "Must choose file to upload for availability id 0";
				renderForm($publication_id, $url, $file_location, $error);
			}elseif($availability_id == 2 && empty($_FILES['fileToUpload']['name'])){
				$error = "Must choose file to upload for availability id 2";
				renderForm($publication_id, $url, $file_location, $error);
			}else if($availability_id == 3 && empty($url)){
				$error = "Must give URL for availability id 3";
				renderForm($publication_id, $url, $file_location, $error);	
			}else{
				if($availability_id == 3){
					mysqli_query($conn, "update publications set availability_id='$availability_id' where publication_id = '$publication_id'");					
					mysqli_query($conn, "delete from url where publication_id = '$publication_id'");
					mysqli_query($conn, "delete from file_location where publication_id = '$publication_id'");
					mysqli_query($conn, "insert into url (url, publication_id) VALUES ('$url', '$publication_id')");
				}elseif($availability_id == 0 || $availability_id == 2){
					define('MB', 1048576);
					//PHP upload script
					$target_dir = "./uploads/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
					$file = $_FILES['fileToUpload'];
					$fileUploadName = $file['name'];
					//echo $file."<br />".$fileUploadName."<br />";
					$path = "/uploads/" . basename($fileUploadName);
					//echo $path."<br />";
					//check if file already exists
					if (file_exists($target_file)) {
						$error = "Sorry, file already exists.";
						$uploadOk = 0;
					}
					//Check file size
					if ($_FILES["fileToUpload"]["size"] > 500*MB) {
						$error =  "Sorry, your file is too large.";
						$uploadOk = 0;
					}
					// limit to certain file type
					if($fileType != "docx" && $fileType != "doc" && $fileType != "pdf" && $fileType != "PDF" && $fileType != "jpeg"  && $fileType != "jpg" && $fileType != "png") {
						$error =  "Sorry, only PDF, DOC, DOCX, PNG, JPEG, JPG files are allowed.";
						$uploadOk = 0;
					}
					if ($uploadOk == 0) {
						$error = "Sorry, your file was not uploaded.";
						// if everything is ok, try to upload file
						echo "here3";
						renderForm($publication_id, $url, $file_location, $error);	
					}else{
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."."<br />";
							//once upload successful, make database entry as well.
							//echo $_POST["fileName"];
							//echo $_POST["fileTags"];
							mysqli_query($conn, "delete from file_location where publication_id = '$publication_id'");
							$sql1 = "INSERT INTO file_location (file_location, publication_id) 
							VALUES ('$path', '$publication_id')";
							if(mysqli_query($conn, $sql1)){
								//echo "file location stored using $sql1";//Records added successfully.";
							} else{
								echo "ERROR: Not able to execute $sql1. " . mysqli_error($conn)."<br />";
							}
							// close connection
							mysqli_close($conn);
						}else {
							echo "Sorry, there was an error uploading your file."."<br />";
						}
						mysqli_query($conn, "insert into file_location (publication_id, file_location) values ('$publication_id', '$fileToUpload')");
						mysqli_query($conn, "update publication set availability_id = '$availability_id' where publication_id = '$publication_id'");
						
					}
						

				}//end file check
			}
			if ($error = ''){
				header("Location: ./searchPublications.php");
			}else{
				echo "here2";
				renderForm($publication_id, $url, $file_location, $error);
			}
		}//end check for blank required fields
	}else 
	{
		// if the form hasn't been submitted, get the data from the db and display the form
		

		// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
		
		
		if (isset($_GET['publication_id']) && is_numeric($_GET['publication_id']) && $_GET['publication_id'] > 0)
		{

			// query db

			$publication_id = $_GET['publication_id'];

			$result = mysqli_query($conn, "SELECT * FROM url WHERE publication_id=$publication_id");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$url = $row['url'];
				
				//echo "here1";
				//renderForm($publication_id, $url, $file_location, $error);

			} 
			$result = mysqli_query($conn, "SELECT * FROM file_location WHERE publication_id=$publication_id");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$file_location = $row['file_location'];
				
				//echo "here";
				
			}
			/*else 
			{
				echo "No results";
			}*/
			renderForm($publication_id, $url, $file_location, $error);
		} 
		else
		{
			echo "ERROR 2";
		}
	}
?>
			
			