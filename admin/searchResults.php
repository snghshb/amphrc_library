<?php
session_start();
include('config.php');
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
//$query = $_GET['query'];
$query = $_SESSION['query'];
//echo $query;
//echo $query;
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
	<title>Administrator - Manage Applications</title>
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

/*

VIEW.PHP

Displays all data from 'players' table

*/



// connect to the database





// get results from database

$result = mysqli_query($conn,$query);

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    //exit();
}

// display data in table

echo "<h3><b>Results</b></h3><hr />";



echo "<table border=\"0px\" width=\"100%\" class=\"table table-hover\">";

//echo "<thead><tr> <th>publication_id</th> <th>category_name</th> <th>title</th> <th>author_first_name</th> <th>author_last_name</th> <th>isbn</th> <th>publisher_name</th> <th>publisher_city</th> <th>publisher_state</th> <th>publisher_country</th> <th>publish_year</th> <th>start_year</th> <th>end_year</th> <th>volume</th> <th>description</th> <th>availability_id</th> <th></th> <th></th> <th></th></tr></thead>";

echo "<thead><tr><th>PUBLICATION_ID</th><th>TITLE</th><th>DESCRIPTION</th><th>AVAILABILITY_ID</th><th colspan=\"2\">ACTIONS</th></tr></thead>";

echo "<tbody>";

// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array($result)) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['publication_id'] . '</td>';

//echo '<td>' . $row['category_name'] . '</td>';

echo '<td>' . $row['title'] . '</td>';

//echo '<td>' . $row['author_first_name'] . '</td>';

//echo '<td>' . $row['author_last_name'] . '</td>';

//echo '<td>' . $row['isbn'] . '</td>';

//echo '<td>' . $row['publisher_name'] . '</td>';

//echo '<td>' . $row['publisher_city'] . '</td>';

//echo '<td>' . $row['publisher_state'] . '</td>';

//echo '<td>' . $row['publisher_country'] . '</td>';

//echo '<td>' . $row['publish_year'] . '</td>';

//echo '<td>' . $row['start_year'] . '</td>';

//echo '<td>' . $row['end_year'] . '</td>';

//echo '<td>' . $row['volume'] . '</td>';

echo '<td>' . $row['description'] . '</td>';

echo '<td align="center"><code><a href="editAvailability.php?publication_id=' . $row['publication_id'] . '">' . $row['availability_id'] . '</a></code></td>';

echo '<td><kbd><a href="editPublicationForm.php?publication_id=' . $row['publication_id'] . '">Edit</a></kbd></td>';

echo '<td><code><a href="delete.php?publication_id=' . $row['publication_id'] . '">Delete</a></code></td>';

//echo '<td><a href="editAvailability.php?publication_id=' . $row['publication_id'] . '">Edit Availability</a></td>';

echo "</tr>";

}

echo "</tbody>";

// close table

echo "</table>";

?>

</td>
	</tr><tr>
	<td><p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> </td>
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