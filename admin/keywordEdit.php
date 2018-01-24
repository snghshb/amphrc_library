<?php
include('config.php');
include ('session.php');
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
	
	function renderForm($keyword_id, $keyword,$error)
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
	<h3>Edit Information about keyword <strong><?php echo $keyword;?></strong></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

?>
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="keyword_id" value="<?php echo $keyword_id; ?>"/>
								<div align="center">	
							<table width="80%" border="0px">	
							<tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Keyword ID</strong></td>
								<td><?php echo $keyword_id;?></td>
								</tr>						
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>KEYWORD</strong></td>
								<td><input type="text" name="keyword" value = "<?php echo $keyword;?>"/></td>
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
	
	// check if the form has been submitted. If it has, process the form and save it to the database
	$error = '';
	if (isset($_POST['submit']))
	{

		// confirm that the 'id' value is a valid integer before getting the form data

		if (is_numeric($_POST['keyword_id']))
		{

			// get form data, making sure it is valid

			//$keyword_id = $_POST['keyword_id'];
			
			$keyword_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['keyword_id']));
			$keyword = mysqli_real_escape_string($conn, htmlspecialchars($_POST['keyword']));
			
			if ($keyword == '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($keyword_id, $keyword, $error);
				}
			else 
			{
                
				$midResult = mysqli_query($conn, "SELECT * FROM keyword where keyword_id = '$keyword_id'");
				while($row = mysqli_fetch_array($midResult)) 
				{
					$keyword_old = $row['keyword'];
			
				}
        		mysqli_query($conn, "UPDATE keyword SET keyword='$keyword' WHERE keyword_id='$keyword_id'");
				$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Updated keyword $keyword_old to $keyword')";
				if(mysqli_query($conn, $sql_log)){
					header("Location: ./keywordOption.php");
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
		
		
		if (isset($_GET['keyword_id']) && is_numeric($_GET['keyword_id']) && $_GET['keyword_id'] > 0)
		{

			// query db

			$keyword_id = $_GET['keyword_id'];

			$result = mysqli_query($conn, "SELECT * FROM keyword WHERE keyword_id=$keyword_id");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$keyword_name = $row['keyword'];
				

				renderForm($keyword_id, $keyword_name, $error);
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