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

/*

VIEW.PHP

Displays all data from 'players' table

*/



// connect to the database
if (isset($_GET['message'])){
			
			echo '<div style="padding:4px; border:1px solid red; color:red;">'."Cannot Delete Record: Author in use by publications".'</div>';

}


include('config.php');

// get results from database

$result = mysqli_query($conn,"SELECT a.author_id, (select count(*) from publication_author p where a.author_id = p.author_id) as count_used, a.author_first_name, a.author_last_name from author a order by author_id asc");



// display data in table

echo "<table class=\"table table-hover\" width=\"80%\">";

echo "<tr> <th>Author ID</th> <th>Count Used</th> <th>Author First name</th> <th>Author Last Name</th><th colspan=\"2\">Actions</th></tr>";



// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array($result)) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['author_id'] . '</td>';

echo '<td>' . $row['count_used'] . '</td>';

echo '<td>' . $row['author_first_name'] . '</td>';

echo '<td>' . $row['author_last_name'] . '</td>';

echo '<td><kbd><a href="authorEdit.php?author_id=' . $row['author_id'] . '">EDIT</a></kbd></td>';

echo '<td><code><a href="authorDelete.php?author_id=' . $row['author_id'] . '">DELETE</a></code></td>';

echo "</tr>";

}



// close table>
echo "</tbody>";

echo "</table>";

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