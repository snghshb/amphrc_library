<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
	//function renderForm($category_id, $category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	
	function renderForm($sample_id, $publication_id, $title, $error)
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
	<title>Administrator - Edit Sample</title>
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
	<h3>Edit category: <?php echo $category_name;?></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

?>
							<div align="center">
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="sample_id" value="<?php echo $sample_id; ?>"/>
								<table width="80%" border="0px">							
								<tr>
								<td>Sample ID</td>
								<td><?php echo $Sample_id;?></td>
								</tr>						
								<tr>
								<td colspan="2"><div class="form-group">
									<label for="title">Publication Name</label>
									<input class="form-control" id="title" type="text" name="title" value="<?php echo $title; ?>">
								</div>
								</td>
								</tr>
								<div class="form-group">
									<label class="control-label col-sm-2"  for="sampleToUpload" name="sampleToUpload">Sample File Location</label>
									<div class="col-sm-offset-2 col-sm-10">
										<input type="file" name="sampleToUpload" id="sampleToUpload">
									</div>
								</div>
	
								<tr>
								<td colspan="2" align="right">* required</td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Sample" name="submit"></td>
								</tr>
								</table>
						</form>
						</div>
				</td>
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

	if (isset($_POST['submit']))
	{

		// confirm that the 'id' value is a valid integer before getting the form data

		if (is_numeric($_POST['sample_id']))
		{

			// get form data, making sure it is valid

			//$category_id = $_POST['category_id'];
			
			$sample_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sample_id']));
			$title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
			
			if ($category_name == '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($category_id,$category_name, $error);
			} 
			else 
			{
				
				$midResult = mysqli_query($conn, "SELECT ps.sample_id, p.publication_id, p.title FROM amphrc_library.sample, amphrc_library.publications WHERE ps.publication_id=p.publication_id AND ps.sample_id = '$sample_id'");
				while($row = mysqli_fetch_array($midResult)) 
				{
					$publication_id = $row['publication_id'];
					$title = row['title'];
			
				}
				
				$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Updated the sample for publication $publication_id')";
	
				if(mysqli_query($conn, $sql_log)){
					header("Location: editSampleForm.php");
					#header('Location: ./authorOption.php');
				}
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
		
		
		if (isset($_GET['sample_id']) && is_numeric($_GET['publication_id']) && $_GET['sample_id'] > 0)
		{

			// query db

			$sample_id = $_GET['sample_id'];

			$result = mysqli_query($conn, "SELECT ps.sample_id, p.publication_id, title FROM amphrc_library.sample, amphrc_library.publications WHERE ps.publication_id=p.publication_id AND ps.sample_id = '$sample_id'");
			
			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$title = $row['title'];
				
				renderForm($sample_id, $publication_id, $title, '');
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
<?php
$conn->close();
}
?>