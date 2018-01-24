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
	<title>Administrator - Manage Categories</title>
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

			echo '<div style="padding:4px; border:1px solid red; color:red;">'."Cannot Delete Record: Category in use by publications".'</div>';

}


include('config.php');
if (isset($_POST['submit'])){
$category_name = strtoupper($_POST['category_name']);
$result = mysqli_query($conn,"SELECT * FROM category where upper(category_name) = upper('$category_name')");
if (mysqli_num_rows($result)==0){
	mysqli_query($conn, "INSERT category SET category_name = '$category_name'");
	header("Location: categoryOption.php");
}else{
	echo "This category already exists";

}
}
// get results from database

$result = mysqli_query($conn,"SELECT c.category_id, c.category_name, (Select count(*) from publications p where p.category_id = c.category_id) as count_used FROM category c Order by Category_name asc");



// display data in table

//echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";



echo "<table class=\"table table-hover\" width=\"80%\">";

echo "<thead><tr> <th>Category ID</th> <th>Count Used</th> <th>Category Name</th> <th colspan=\"2\">Actions</th></tr></thead>";

// loop through results of database query, displaying them in the table

echo "<tbody>";

while($row = mysqli_fetch_array($result)) {

// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['category_id'] . '</td>';

echo '<td>' . $row['count_used'] . '</td>';

echo '<td>' . $row['category_name'] . '</td>';

echo '<td><a href="categoryEdit.php?category_id=' . $row['category_id'] . '"><kbd>EDIT</kbd></a></td>';

echo '<td><a href="categoryDelete.php?category_id=' . $row['category_id'] . '"><code>DELETE</code></a></td>';

echo "</tr>";

}



// close table>
echo "</tbody>";
echo "</table>";

?>

</td>
	</tr>
	<tr>
	<td><p>&nbsp;&nbsp;&nbsp;</p></td>
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