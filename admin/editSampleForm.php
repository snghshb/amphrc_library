<?php
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
      $("#includeFooter").load("footer2.html"); 
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
	<h3>Edit Sample</h3>
		<hr />
<?php

// connect to the database
if (isset($_GET['message'])){
			echo '<div style="padding:4px; border:1px solid red; color:red;">'."Cannot Delete Sample".'</div>';
}

include('config.php');
// get results from database

$result = mysqli_query($conn,"SELECT ps.sample_id, p.publication_id, p.title from publication_sample ps, publications p WHERE ps.publication_id=p.publication_id");

// display data in table

echo "<table class=\"table table-hover\" width=\"80%\">";

echo "<tr> <th>Sample ID</th><th>Publication Name</th><th>Actions</th></tr>";

// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array($result)) {
// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['sample_id'] . '</td>';

echo '<td>'. $row['title'] .'</td>';

//echo '<td><a href="sampleEdit.php?sample_id=' . $row['sample_id'] . '">Edit</a></td>';

echo '<td><code><a href="sampleDelete.php?sample_id=' . $row['sample_id'] . '">DELETE</a></code></td>';

echo "</tr>";

}

// close table>
echo "</tbody>";
echo "</table>";

?>

	</td>
	</tr>
	<tr>
	<td>To edit an existing Sample, <code>DELETE</code> the old sample on top and create a new entry by <a href="./addNewSampleForm.php">clicking here</a></td>
	</tr>
	<tr>
	<td><hr /><p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p></td>
	</tr>
	<tr>
	<td><div id="includeFooter"></div></td>
	</tr>
	</table>
</div>
</body>
</html>
<?php
$conn->close();
}
?>