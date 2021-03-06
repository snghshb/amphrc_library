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
	<title>Administrator - Landing Page</title>
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
	<?php
// connect to the database
include('config.php');

// get results from database
$result = mysqli_query($conn,"SELECT * FROM publications");

// display data in table
echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";

echo "<table border='1px' width=\"100%\">";

echo '<tr>
	<th>ID</th>
	<th width="80%">File Information</th>
	<th colspan="3">Actions</th>
	</tr>';

// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array($result)) {
// echo out the contents of each row into a table
	echo '<tr>';
	echo '<td rowspan="3">' . $row['publication_id'] . '</td>';
	echo '<td width="300px">' . $row['title'] . '</td>';
	echo '<td colspan="3">';
	$availability_id = $row['availability_id'];
	if ($availability_id == 0)
		echo "Online";
	else if ($availability_id == 1)
		echo "On-premise";
	else if ($availability_id == 2)
		echo "Online/on-premise";
	else echo "Partner";
	echo '</td>';
	echo '</tr><tr>';
	echo '<td width="300px">' . $row['description'] . '</td>';
	echo '<td rowspan="2"><a href="viewAllDetails.php?publication_id=' . $row['publication_id'] . '">
	<img src="../css/images/view.png" alt="edit" class="icon" title="FileView" /></a></td>';
	echo '<td rowspan="2"><a href="editExisting.php?publication_id=' . $row['publication_id'] . '">
	<img src="../css/images/edit.png" alt="edit" class="icon" title="FileEdit" /></a></td>';
	echo '<td rowspan="2"><a href="delete.php?publication_id=' . $row['publication_id'] . '">
	<img src="../css/images/delete.png" alt="delete" class="icon" title="FileDelete" /></a></td>';
	echo '</tr>';
	echo '<td>';
	$category_id = $row['category_id'];
	$result1 = mysqli_query($conn,"SELECT * FROM category WHERE category_id=$category_id");
	while ($row1 = mysqli_fetch_array($result1))
			echo $row1['category_name'];
	echo '</td>';
	
}

// close table>
echo "</table>";
?>
<p><a href="fileuploadform.php">Add a new record</a></p>
	</td>
	</tr>
	<tr>
	<td><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
	</tr>
	<tr>
	<td><div id="includeFooter"></div></td>
	</tr>
	</table>
</div>
</div>
</body>
</html>
<?php
$conn->close();
}
?>