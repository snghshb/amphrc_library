<?php

	//function renderForm($publication_id, $category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	
	function renderForm($publication_id,$category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error)
	{

?>
		<html>
<head>
	<title>Administrator - template</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
</head>
<body>
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
									<td><a href="./fileuploadform.php" class="button">Upload file</a></td>
								</tr>
								<!--tr>
									<td><a href="./addInformation.php" class="button">Add Information</td>
								</tr-->
								<tr>
									<td><a href="./viewExisting.php" class="button">View existing library</a></td>
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
		<form action="" method="post">
			<input type="hidden" name="publication_id" value="<?php echo $publication_id; ?>"/>
			<div>
				<table border="1px" width="100%">
					<!--tr>
						<td><strong>publication ID:</strong><?php echo $publication_id; ?>
					</tr-->
					<tr>
						<td width="20%"><strong>Category ID: *</strong></td>
						<td><input type="text" name="category_id" value="<?php echo $category_id; ?>"/></td>
					</tr>
					<tr>
						<td><strong>Title: *</strong></td>
						<td><input type="text" name="title" value="<?php echo $title; ?>"/></td>
					</tr>
					<tr>
						<td><strong>isbn: </strong></td>
						<td><input type="text" name="isbn" value="<?php echo $isbn; ?>"/></td>
					</tr>
					<tr>
						<td><strong>publish year: </strong></td>
						<td><input type="text" name="publish_year" value="<?php echo $publish_year; ?>"/></td>
					</tr>
					<tr>
						<td><strong>start year: </strong></td>
						<td><input type="text" name="start_year" value="<?php echo $start_year; ?>"/></td>
					</tr>
					<tr>
						<td><strong>end year: </strong>
						<td><input type="text" name="end_year" value="<?php echo $end_year; ?>"/></td>
					</tr>
					<tr>
						<td><strong>volume: </strong>
						<td><input type="text" name="volume" value="<?php echo $volume; ?>"/></td>
					</tr>
					<tr>
						<td><strong>description: </strong>
						<td><input type="text" name="description" value="<?php echo $description; ?>"/></td>
					</tr>
					<tr>
						<td><strong>availability ID: *</strong>
						<td><input type="text" name="availability_id" value="<?php echo $availability_id; ?>"/></td>
					</tr>
				</table>
				<p>* Required</p>
				<input type="submit" name="submit" value="Submit">
			</div>
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
	include("config.php");

	// check if the form has been submitted. If it has, process the form and save it to the database
	if (isset($_POST['submit']))
	{
		// confirm that the 'id' value is a valid integer before getting the form data
		if (is_numeric($_POST['publication_id']))
		{
			// get form data, making sure it is valid

			//$publication_id = $_POST['publication_id'];
			$publication_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publication_id']));
			$category_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category_id']));
			$title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
			$isbn = mysqli_real_escape_string($conn, htmlspecialchars($_POST['isbn']));
			$publish_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publish_year']));
			$start_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['start_year']));
			$end_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['end_year']));
			$volume = mysqli_real_escape_string($conn, htmlspecialchars($_POST['volume']));
			$description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['description']));
			$availability_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['availability_id']));
			
			if ($category_id == '' || $title == '' || $availability_id = '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($publication_id,$category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error);
			} 
			else 
			{
				mysqli_query($conn, "UPDATE publications SET category_id='$category_id', title='$title', isbn='$isbn',publish_year='$publish_year',end_year='$end_year',volume='$volume',description='$description',availability_id='$availability_id' WHERE publication_id='$publication_id'");
				header("Location: viewExisting.php");
			}
		} 
		else 
		{
			echo 'ERROR 1';
		}
	} 
	else 
	{
		// if the form hasn't been submitted, get the data from the db and display the form
		// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
		
		if (isset($_GET['publication_id']) && is_numeric($_GET['publication_id']) && $_GET['publication_id'] > 0)
		{
			// query db
			$publication_id = $_GET['publication_id'];
			$result = mysqli_query($conn, "SELECT * FROM publications WHERE publication_id=$publication_id");
			$row = mysqli_fetch_array($result);
			if($row)
			{
				// get data from db
				$category_id = $row['category_id'];
				$title = $row['title'];
				$isbn = $row['isbn'];
				$publish_year = $row['publish_year'];
				$start_year = $row['start_year'];
				$end_year = $row['end_year'];
				$volume = $row['volume'];
				$description = $row['description'];
				$availability_id = $row['availability_id'];
				renderForm($publication_id,$category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, '');
			} 
			else 
			{
				echo "No results";
			}
		} 
		else
		{
			echo "ERROR 2";
		}
	}
?>