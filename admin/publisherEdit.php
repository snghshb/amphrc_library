	<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
	//function renderForm($publisher_id, $publisher_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	
	function renderForm($publisher_id, $publisher_name, $publisher_city, $publisher_state, $publisher_country, $error)
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
	<h3>Edit Publisher information for Publisher <?php echo $publisher_name." (".$publisher_city.", ".$publisher_country.")";?></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

?>
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="publisher_id" value="<?php echo $publisher_id; ?>"/>
							<div align="center">	
							<table width="80%" border="0px">							
								<!--tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Publisher ID</strong></td>
								<td><?php echo $publisher_id;?></td>
								</tr-->						
								<tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Publisher Name</strong></td>
								<td width="70%"><input type="text" name="publisher_name" value = "<?php echo $publisher_name;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Publisher City</strong></td>
								<td><input type="text" name="city" value = "<?php echo $publisher_city;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Publisher State</strong></td>
								<td><input type="text" name="state" value = "<?php echo $publisher_state;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Publisher Country</strong></td>
								<td><input type="text" name="country" value = "<?php echo $publisher_country;?>"/></td>
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
<!--div id="includeFooter"></div>-->
</div>
</body>
</html>

</html>

<?php

	}
		
	include("config.php");
	
	// check if the form has been submitted. If it has, process the form and save it to the database
	$error = '';
	if (isset($_POST['submit']))
	{

		// confirm that the 'id' value is a valid integer before getting the form data

		if (is_numeric($_POST['publisher_id']))
		{

			// get form data, making sure it is valid

			//$publisher_id = $_POST['publisher_id'];
			
			$publisher_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publisher_id']));
			$publisher_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publisher_name']));
			$publisher_city = mysqli_real_escape_string($conn, htmlspecialchars($_POST['city']));
			$publisher_state = mysqli_real_escape_string($conn, htmlspecialchars($_POST['state']));
			$publisher_country = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country']));
			
			if ($publisher_name == '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($publisher_id, $publisher_name, $publisher_city, $publisher_state, $publisher_country, $error);
			}
			else 
			{
				mysqli_query($conn, "UPDATE publisher SET publisher_name='$publisher_name', city = '$publisher_city', `state` = '$publisher_state', country = '$publisher_country' WHERE publisher_id='$publisher_id'");
				$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Updated a publisher with id $publisher_id')";
				if(mysqli_query($conn, $sql_log)){}
			}
				header("Location: ./publisherOption.php");
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
		
		
		if (isset($_GET['publisher_id']) && is_numeric($_GET['publisher_id']) && $_GET['publisher_id'] > 0)
		{

			// query db

			$publisher_id = $_GET['publisher_id'];

			$result = mysqli_query($conn, "SELECT * FROM publisher WHERE publisher_id=$publisher_id");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$publisher_name = $row['publisher_name'];
				$publisher_city = $row['city'];
				$publisher_state = $row['state'];
				$publisher_country = $row['country'];

				renderForm($publisher_id, $publisher_name, $publisher_city, $publisher_state, $publisher_country, $error);
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
	$conn->close();

	}
?>
			
			