<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {

	//function renderForm($author_id, $author_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	
	function renderForm($author_id, $author_first_name, $author_last_name, $error)
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
	<h3>Edit Author information for Author <strong><?php echo $author_first_name." ".$author_last_name;?></strong></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

?>							
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="author_id" value="<?php echo $author_id; ?>"/>
							<div align="center">	
							<table width="80%" border="0px">							
								<tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Author ID</strong></td>
								<td><?php echo $author_id;?></td>
								</tr>						
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Author First Name</strong></td>
								<td><input type="text" name="author_first_name" value = "<?php echo $author_first_name;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Author Last Name</strong></td>
								<td><input type="text" name="author_last_name" value = "<?php echo $author_last_name;?>"/></td>
								</tr>
								<tr>
								<td align="right" colspan="2" style="padding-right: 10px;"><strong>All fields are required</strong></td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Record" name="submit"></td>
								</tr>
								</table>
								</div>
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
	$error = '';
	// check if the form has been submitted. If it has, process the form and save it to the database

	if (isset($_POST['submit']))
	{

		// confirm that the 'id' value is a valid integer before getting the form data

		if (is_numeric($_POST['author_id']))
		{

			// get form data, making sure it is valid

			//$author_id = $_POST['author_id'];
			
			$author_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['author_id']));
			$author_first_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['author_first_name']));
			$author_last_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['author_last_name']));
			
			if ($author_last_name == '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($author_id, $author_first_name, $author_last_name, $error);
			} 
			else 
			{
				$midResult = mysqli_query($conn, "SELECT * FROM author where author_id = '$author_id'");
				while($row = mysqli_fetch_array($midResult)) 
				{
					$author_first_name_old = $row['author_first_name'];
					$author_last_name_old = $row['author_last_name'];
			
				}
				mysqli_query($conn, "UPDATE author SET author_first_name='$author_first_name', author_last_name = '$author_last_name' WHERE author_id='$author_id'");
				
				$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Updated the author from \"$author_first_name_old \" \"$author_last_name_old \" to \"$author_first_name \" \"$author_last_name \", author_id $author_id')";
	
				if(mysqli_query($conn, $sql_log)){
					header('Location: ./authorOption.php');
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
		
		
		if (isset($_GET['author_id']) && is_numeric($_GET['author_id']) && $_GET['author_id'] > 0)
		{

			// query db

			$author_id = $_GET['author_id'];

			$result = mysqli_query($conn, "SELECT * FROM author WHERE author_id=$author_id");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$author_first_name = $row['author_first_name'];
				$author_last_name = $row['author_last_name'];
				renderForm($author_id, $author_first_name, $author_last_name, $error);
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
			