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
if (isset($_GET['message'])){
			
			echo '<div style="padding:4px; border:1px solid red; color:red;">'."Cannot Delete Record: keyword in use by publications".'</div>';

}


include('config.php');

// get results from database

$result = mysqli_query($conn,"SELECT a.keyword_id, (select count(*) from publication_keyword p where a.keyword_id = p.keyword_id) as count_used, a.keyword from keyword a order by keyword asc");



// display data in table

echo "<table class=\"table table-hover\" width=\"80%\">";

echo "<tr> <th>keyword id</th> <th>count used</th> <th>keyword</th> <th colspan=\"2\" align=\"center\">Actions</th></tr>";



// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array($result)) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['keyword_id'] . '</td>';

echo '<td>' . $row['count_used'] . '</td>';

echo '<td>' . $row['keyword'] . '</td>';

echo '<td><kbd><a href="./keywordEdit.php?keyword_id=' . $row['keyword_id'] . '">Edit</a></kbd></td>';

echo '<td><code><a href="./keywordDelete.php?keyword_id=' . $row['keyword_id'] . '">Delete</a></code></td>';

echo "</tr>";

}



// close table>
echo "</tbody>";
echo "</table>";

?>

</td>
	</tr>
	<tr>
	<td><p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> 
</td>
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