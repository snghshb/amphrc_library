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
	<title>Administrator - Edit Authors</title>
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
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
/*

VIEW.PHP

Displays all data from 'players' table

*/



// connect to the database
if (isset($_GET['message'])){
			
			echo '<div style="padding:4px; border:1px solid red; color:red;">'."Cannot Delete Record: publisher in use by publications".'</div>';

}


include('config.php');

// get results from database

$result = mysqli_query($conn,"SELECT a.publisher_id, (select count(*) from publication_publisher p where a.publisher_id = p.publisher_id) as count_used, a.publisher_name, a.city, a.`state`, a.country from publisher a order by publisher_id asc");



// display data in table

echo "<table class=\"table table-hover\" width=\"80%\">";

echo "<tr> <th>publisher id</th> <th>Count used</th> <th>Publisher Name</th> <th>City</th> <th>State</th> <th>Country</th> <th colspan=\"2\">Actions</th></tr>";



// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array($result)) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['publisher_id'] . '</td>';

echo '<td>' . $row['count_used'] . '</td>';

echo '<td>' . $row['publisher_name'] . '</td>';

echo '<td>' . $row['city'] . '</td>';

echo '<td>' . $row['state'] . '</td>';

echo '<td>' . $row['country'] . '</td>';

echo '<td><kbd><a href="./publisherEdit.php?publisher_id=' . $row['publisher_id'] . '">Edit</a></kbd></td>';

echo '<td><code><a href="./publisherDelete.php?publisher_id=' . $row['publisher_id'] . '">Delete</a></code></td>';

echo "</tr>";

}



// close table>

echo "</table>";
$conn->close();
}

?>


</td>
	</tr>
	</table>
</div>
<div id="includeFooter"></div>
</div>
</body>
</html>