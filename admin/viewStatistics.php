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
	<title>Administrator - Satistics</title>
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
	<table border="0px" width="60%" height="400px" class="marginTable">
	<tr>
	<td valign="top">
	
		<h3>View Statistics for the website<br /></h3>
		<hr />
		<p>Following are the statistics for the library website</p>
		<form action="" method="post" enctype="multipart/form-data">
								<table class="table table-hover">							
								<tbody>
								<tr>
								<td>Number of Publications </td>
								<td><?php
								$sql = mysqli_query($conn, "select count(*) as pubcount from publications");
								$row = mysqli_fetch_array($sql);
								echo $pubcount = $row['pubcount'];
								?></td>
								</tr>
								<tr>
								<td>Number of Files Uploaded</td>
								<td><?php
								$sql = mysqli_query($conn, "select count(*) as catcount from file_location");
								$row = mysqli_fetch_array($sql);
								echo $filecount = $row['catcount'];								
								?></td>
								</tr>
								<tr>
								<td>Number of Urls Provided</td>
								<td><?php
								$sql = mysqli_query($conn, "select count(*) as catcount from url");
								$row = mysqli_fetch_array($sql);
								echo $urlcount = $row['catcount'];
								?></td>
								</tr>								
								<tr>
								<td>Number of Publications Available Physically</td>
								<td><?php
								$sql = mysqli_query($conn, "select count(*) as pubcount from publications where availability_id = 1 or availability_id = 2");
								$row = mysqli_fetch_array($sql);
								echo $libcount = $row['pubcount'];
								?></td>
								</tr>
								<tr>
								<td>Number of Unique Categories</td>
								<td><?php
								$sql = mysqli_query($conn, "select count(*) as catcount from category");
								$row = mysqli_fetch_array($sql);
								echo $catcount = $row['catcount'];								
								?></td>
								</tr>
								<tr>
								<td>Number of Unique Categories in Use</td>
								<td><?php
								$sql = mysqli_query($conn, "SELECT Count(category_id) FROM category c where (Select count(*) from publications p where p.category_id = c.category_id) > 0 Order by Category_name asc");
								$row = mysqli_fetch_array($sql);
								echo $catused = $row['Count(category_id)'];								
								?></td>
								</tr>
								<tr>
								<td>Number of Publishers</td>
								<td><?php
								$sql = mysqli_query($conn, "select count(*) as catcount from publisher");
								$row = mysqli_fetch_array($sql);
								echo $publcount = $row['catcount'];
								?></td>
								</tr>
								<tr>
								<td>Number of Publishers in Use</td>
								<td><?php
								$sql = mysqli_query($conn, "SELECT Count(publisher_id) FROM publisher c where (Select count(*) from publication_publisher p where p.publisher_id = c.publisher_id) > 0");
								$row = mysqli_fetch_array($sql);
								echo $publused = $row['Count(publisher_id)'];
								?></td>
								</tr>
								<tr>
								<td>Number of Authors</td>
								<td><?php
								$sql = mysqli_query($conn, "select count(*) as catcount from author");
								$row = mysqli_fetch_array($sql);
								echo $autcount = $row['catcount'];
								?></td>
								</tr>
								<tr>
								<td>Number of Authors in Use</td>
								<td><?php
								$sql = mysqli_query($conn, "SELECT Count(author_id) FROM author c where (Select count(*) from publication_author p where p.author_id = c.author_id) > 0");
								$row = mysqli_fetch_array($sql);
								echo $autused = $row['Count(author_id)'];
								?></td>
								</tr>
								<tr>
								<td>Number of Keywords</td>
								<td><?php
								$sql = mysqli_query($conn, "select count(*) as catcount from keyword");
								$row = mysqli_fetch_array($sql);
								echo $tagcount = $row['catcount'];
								?></td>
								</tr>
								<tr>
								<td>Number of Keywords in Use</td>
								<td><?php
								$sql = mysqli_query($conn, "SELECT Count(keyword_id) FROM keyword c where (Select count(*) from publication_keyword p where p.keyword_id = c.keyword_id) > 0");
								$row = mysqli_fetch_array($sql);
								echo $tagused = $row['Count(keyword_id)'];
								?></td>
								</tr>
								</tbody>								
								</table>
						</form>
	
	</td>
<tr>
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