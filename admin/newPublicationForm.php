<?php
	include('config.php');
	function renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publish_year, $start_year, $end_year, $volume, $description, $url, $error, $conn){
?>
<html>
<head>
	<title>Administrator - New Publication</title>
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
</head>

<body>
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}
		

?>
<div align="center">
		<table class="style1">
			<tr>
				<td><a href="./landingpage.php" target="_blank"><img src="../css/images/logo.png" alt="logo"  title="AMPHRC Library Administrator" /></a></td>
			</tr>
			<tr>
			<td>
				<table class="style2">
					<tr>
						<td align="left"><a href="./landingpage.php"><img src="../css/images/home.png" alt="home" class="icon" title="Library Admin Home" /></a></td>
						<td align="right"><a href="./adminhelp.html" target="_blank"><img src="../css/images/info.png" alt="home" class="icon" title="Library Help" /></a>   <a href="./logout.php"><img src="../css/images/logout.png" alt="home" class="icon" title="Admin Logout" /></a></td>
					</tr>
					<tr>
						<td class="contentDiv" width="25%" valign="top" align="center">
							<table class="leftNavigationPane">
								<tr>
									<td><a href="./newPublicationForm.php" class="button">Create New Record</a></td>
								</tr>
								<tr>
									<td><a href="./manageData.php" class="button">Manage Data</a></td>
								</tr>
								<tr>
									<td><a href="./viewStatistics.php" class="button">Statistics</a></td>
								</tr>
								<tr>
									<td><a href="../home.html" target="_blank" class="button">View as user</a></td>
								</tr>
							</table>
						</td>
						<td class="contentDiv">
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
							<table border="1px">
							<tr>
							<td>Select Category *</td>
								<td><select name = 'category_name'>
<?php
										echo "<option value = '' selected = 'selected' ></option>";
										$sql = "Select category_name from category where category_name != '$category_name' order by category_name asc";
										$result = mysqli_query($conn, $sql);
										while ($row = mysqli_fetch_array($result)){
											echo "<option value = '".$row['category_name']."'>".$row['category_name']."</option>";
										}
?>
								</select></td>
							</tr>
							<tr>
							<td>Enter Title *</td> 
							<td><input type="text" name="title" value="<?php echo $title; ?>" /></td>
							</tr>
							<tr>
							<td>Enter Author First Name</td>
							<td><input type="text" name="author_first_name" value="<?php echo $author_first_name; ?>" />
							</tr>
							<td>Enter Author Last Name</td>
							<td><input type="text" name="author_last_name" value="<?php echo $author_last_name; ?>" />
							</tr>
							<tr>
							<td>Enter ISBN</td> 
							<td><input type="text" name="isbn" value="<?php echo $isbn; ?>" /></td>
							</tr>
							<tr>
							<td>Select Publisher Name</td> 
							<td><select name = 'publisher_name'>
<?php
										echo "<option value = '' selected = 'selected'></option>";
										$sql = "Select publisher_name from publisher order by publisher_name asc";
										$result = mysqli_query($conn, $sql);
										while ($row = mysqli_fetch_array($result)){
										echo "<option value='" . $row['publisher_name'] . "'>".$row['publisher_name']."</option>";
										}
?>
							</select></td>							
							</tr>
							<td>Enter Start Year</td> 
							<td><input type="text" name="start_year" value="<?php echo $start_year; ?>" /></td>
							</tr>
							<tr>
							<td>Enter End Year</td> 
							<td><input type="text" name="end_year" value="<?php echo $end_year; ?>" /></td>
							</tr>
							<tr>
							<td>Enter Volume</td>
							<td><input type="text" name="volume" value="<?php echo $volume; ?>" /></td>
							</tr>
							<tr>
							<td>Enter Description</td>
							<td><input type="text" name="description" value="<?php echo $description; ?>" /></td>
							</tr>
							<tr>
							<td>Select Availability</td>
							<td><select name = "availability_id" id = "availability_id" onchange="codename()">
								<option value = '0'>0: Uploading File to Online Library Only</option>
								<option value = '1'>1: Available Only On-premise Library</option>
								<option value = '2'>2: Uploading File and Available On-premise</option>
								<option value = '3'>3: Available at Partner Website</option>
							</select></td>
							</tr
							<tr>
							<td>Partner Database URL</td>
							<td><input type="text" name="url" id = "url" value="<?php echo $url; ?>" /></td>
							<tr>
							<tr>
							<td>Current File</td>
							<td><?php echo $file_location ?></td>
							<tr>
							<td>Upload File</td>
							<td><input type="file" name="fileToUpload" id="fileToUpload">
							<br /><p class="footnote">Allowed file types are PDF, DOC, DOCX, JPG, JPEG, PNGs</p>
							</td>
							</tr>
							<tr>
							<td>Tags (one per line) *</td>
							<td><textarea type="text" name="tags"  cols="40" rows="7"></textarea></td>
							</tr>
							<tr>
							<td>* required</td>
							</tr>
							<tr>
							<td colspan="2" align="center"><input type="submit" value = "Create Record" name="submit"></td>
							</tr>
							</table>
						</form>
				</td>
					</tr>
					<tr>
						<td colspan="2" class="disclaimer">Asia Minor and Pontos Hellenic Research Center Inc © 2017 All Rights Reserved.</td>
					</tr>
				</table>
			</td>
			</tr>
		</table>
	</div>
</body>
</html>
<?php
	}
	if (isset($_POST['submit'])){
		$uploadOk = 1;
		$title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
		$result = mysqli_query($conn, "SELECT title from publications where title='$title'");
		
		if(mysqli_num_rows($result)==0){	

			$publisher_id = '';
			$category_id = '';
			$author_id = '';
			$keyword_id = '';
			$publication_id = '';
			
			$category_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category_name']));
			$author_first_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['author_first_name']));
			$author_last_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['author_last_name']));
			$isbn = mysqli_real_escape_string($conn, htmlspecialchars($_POST['isbn']));
			$publisher_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publisher_name']));
			$publish_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publish_year']));
			$start_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['start_year']));
			$end_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['end_year']));
			$volume = mysqli_real_escape_string($conn, htmlspecialchars($_POST['volume']));
			$description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['description']));
			
			//$target_file = $_FILES['fileToUpload']['name'];
						
			$availability_id = $_POST['availability_id'];
			if(isset($_POST['url'])){
				$url = $_POST['url'];
			}
			if($availability_id == 0 && empty($_FILES['fileToUpload']['name'])){
				$error = "Must choose file to upload for availability id 0";
				renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publish_year, $start_year, $end_year, $volume, $description, $url, $error, $conn);
			}elseif($availability_id == 2 && empty($_FILES['fileToUpload']['name'])){
				$error = "Must choose file to upload for availability id 2";
				renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publish_year, $start_year, $end_year, $volume, $description, $url, $error, $conn);
			}else if($availability_id == 3 && empty($url)){
				$error = "Must give URL for availability id 3";
				renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publish_year, $start_year, $end_year, $volume, $description, $url, $error, $conn);	
			}else{
					
				
				
				
				if ($availability_id == "0" || $availability_id == "2"){
					
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
						} 
					
					
					
				}
				
				if (empty($error)){
					$taginput = isset($_POST['tags'])?$_POST['tags']:"";
					//$taginput = $_POST['tags'];
					/*if(strlen($taginput==0)){
						$error = "No tags given";
		
					}*/
					$tags = explode("\n", str_replace("\r", "", $taginput));
					if(!isset($tags) || empty($tags)){
						$error = "No Tags Given";
					}
					/*foreach ($tags as $value){
						echo $value."\n";
					}*/
					
					if(empty($error)){
						if ( $category_name == '' || $title == '' ||  $tags == '' ){
							// generate error message
							$error = 'ERROR: Please fill in all required fields!';
							// if either field is blank, display the form again
							renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publish_year, $start_year, $end_year, $volume, $description, $url, $error, $conn);
						}else{
							//echo "You made it this far";
							
							$result = mysqli_query($conn, "SELECT * from category where upper(category_name)=upper('$category_name')");			
							
							if(mysqli_num_rows($result)==0){
								mysqli_query($conn, "insert into category (category_name) values ('$category_name')");
								$result = mysqli_query($conn, "select * from category where category_name = upper('$category_name')");
								while($row = mysqli_fetch_array($result)) {
								$category_id = $row['category_id'];
								}
							}
							else{
								while($row = mysqli_fetch_array($result)) {
								$category_id = $row['category_id'];
							}
							}
							
							if(!empty($author_last_name) || !empty($author_first_name)){
								$result = mysqli_query($conn, "SELECT * from author where upper(author_first_name)=upper('$author_first_name') and upper(author_last_name)=upper('$author_last_name')");
								if(mysqli_num_rows($result)==0){
									mysqli_query($conn, "insert into author (author_first_name, author_last_name ) values ('$author_first_name','$author_last_name')");
									$result = mysqli_query($conn, "SELECT * from author where upper(author_first_name)=upper('$author_first_name') and upper(author_last_name)=upper('$author_last_name')");
									while($row = mysqli_fetch_array($result)) {
									$author_id = $row['author_id'];
									}
								}
								else{
									while($row = mysqli_fetch_array($result)) {
									$author_id = $row['author_id'];
									}
								}
							}
							if(!empty($publisher_name)){
								//echo "Publisher Name: ".$publisher_name;
								$result = mysqli_query($conn, "SELECT * FROM `publisher` WHERE upper(publisher_name) = upper('$publisher_name') ");
								if(mysqli_num_rows($result)==0){
									mysqli_query($conn, "insert into publisher (publisher_name, city , `state/province`, country)values ('$publisher_name','$publisher_city','$publisher_state','$publisher_country')");
								//	echo "publisher info passed";
									$result = mysqli_query($conn, "SELECT * FROM `publisher` WHERE upper(publisher_name) = upper('$publisher_name') and upper(city) = upper('$publisher_city') and upper(`state/province`) = upper('$publisher_state') and upper(country) = upper('$publisher_country')");
									while($row = mysqli_fetch_array($result)) {
									$publisher_id = $row['publisher_id'];
								//echo "publisher id after insert into : ".$publisher_id;
								}
								}
								else{
									while($row = mysqli_fetch_array($result)) {
									$publisher_id = $row['publisher_id'];
									}
								}
								
							}	
							
							foreach ($tags as $value){
								//echo $value." ";
								$result = mysqli_query($conn, "SELECT * from keyword where upper(keyword)=upper('$value')");
								if(mysqli_num_rows($result)==0){
									mysqli_query($conn, "insert into keyword (keyword) values ('$value')");
									
									}
							}
							
							
								
							//mysqli_query($conn, "insert into publications value publication_id = '$publication_id', category_id='$category_id', title='$title', isbn='$isbn', publish_year='$publish_year', start_year='$start_year', end_year='$end_year', volume='$volume', description='$description', availability_id='$availability_id'")
							mysqli_query($conn, "insert into publications (category_id, title, isbn, publish_year, start_year, end_year, volume, description, availability_id) values ('$category_id', '$title', '$isbn', '$publish_year', '$start_year', '$end_year', '$volume', '$description', '$availability_id')");;
							$result = mysqli_query($conn, "SELECT * FROM publications WHERE category_id='$category_id' and title='$title' and isbn='$isbn' and publish_year='$publish_year' and start_year='$start_year' and end_year='$end_year' and volume='$volume' and description='$description' and availability_id='$availability_id'");
							
							while($row = mysqli_fetch_array($result)) {
								$publication_id = $row['publication_id'];
							}
							
							
							if(isset($publisher_name)){
							mysqli_query($conn, "insert into publication_publisher (publication_id, publisher_id) values ('$publication_id', '$publisher_id')");;
							}
							//echo $publication_id. " ". $publisher_id. " "."insert into publication_publisher (publication_id, publisher_id) values ('$publication_id', '$publisher_id')";

							if(isset($author_last_name) || isset($author_first_name)){

							mysqli_query($conn, "insert into publication_author (publication_id, author_id) values ('$publication_id', '$author_id')");;
							}
							
							foreach ($tags as $value){
							$result = mysqli_query($conn, "SELECT * from keyword where upper(keyword)=upper('$value')");
							//echo "keyword id: ";
								while($row = mysqli_fetch_array($result)) {
									$keyword_id = $row['keyword_id'];
									//echo $keyword_id. " ";
									
									mysqli_query($conn, "insert into publication_keyword (publication_id, keyword_id) values ('$publication_id', '$keyword_id')");
								}
							}
							
							
							if(!empty($url)){
								mysqli_query($conn, "insert into url (publication_id, url) values ('$publication_id', '$url')");

							}
							if(!empty($fileToUpload)){
								if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
									//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."."<br />";
									
									//once upload successful, make database entry as well.
									
									//echo $_POST["fileName"];
									//echo $_POST["fileTags"];
									
									
									$sql1 = "INSERT INTO file_location (file_location, publication_id) 
									VALUES ('$path', $publication_id)";
								
									if(mysqli_query($conn, $sql1)){
										//echo "file location stored using $sql1";//Records added successfully.";
										} else{
											echo "ERROR: Not able to execute $sql1. " . mysqli_error($conn)."<br />";
											}
											
									$sql2 = "INSERT INTO publication_author (publication_id,author_id) 
									VALUES ($publication_id,$author_id)";
								
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
								mysqli_query($conn, "insert into fileToUpload (publication_id, fileToUpload) values ('$publication_id', '$fileToUpload')");

							}
							
						}
						$error = "Record Created";
						renderForm('','','','','','','','','','','','',$error, $conn);

					} else {
						renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publish_year, $start_year, $end_year, $volume, $description, $url, $error, $conn);
						
					}
				} else {
					renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publish_year, $start_year, $end_year, $volume, $description, $url, $error, $conn);
				}
			}
		} else {
				echo "A publication with this title already exists. Modify or delete that one.";
		}
	} else{
		$uploadOk = 1;
		renderForm('','','','','','','','','','','','','', $conn);
}
?>