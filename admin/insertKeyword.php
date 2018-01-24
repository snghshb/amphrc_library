<?php
include('config.php');
include ('session.php');
	//function renderForm($publication_id, $publication_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
	
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
	<title></title>
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
	<?php
include('config.php');
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$newKeyword = mysqli_real_escape_string($conn, $_REQUEST['newKeyword']);
 
// attempt insert query execution
$sql = "INSERT INTO amphrc_library.keyword (keyword) VALUES ('$newKeyword')";
if(mysqli_query($conn, $sql)){
    echo "Category: <h4>".$newKeyword."</h4> added successfully.";
	echo "<br />The page will redirect you shortly...";
	//sleep(7);
	$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Inserted a new Keyword $newKeyword')";
	
	if(mysqli_query($conn, $sql_log)){
	header('Location: ./keywordOption.php');
	}
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
// close connection
mysqli_close($conn);
?>
</td>
	</tr>
	</table>
</div>
<div id="includeFooter"></div>
</div>
</body>
</html>
<?php
$conn->close();
}
?>