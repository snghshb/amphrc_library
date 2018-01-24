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
	<link rel="stylesheet" href="css/custom.css">
	<title>Access with partner website</title>
	<script>
	function validateForm() {
		var x = document.forms["searchForm"]["searchTerms"].value;
		if (x == "") {
			alert("Search query cannot be blank.");
			return false;
		}
		var pattern = new RegExp(/[~`!#$%\^&*+=\-\[\]\\';,{}|\\":<>\?]/); //unacceptable chars
		if (pattern.test(x)) {
			alert("Please input only standard alphanumerical characters in search box");
				return false;
			}
		}
	</script>
		<script> 
    $(function(){
      $("#includeFooter").load("footer2.html"); 
    });
    </script>

</head>
<body>
<div class="wrapper">
<div class="container full-width-div">
	<div class="page-header" align="center">
	<table>
			<tr>
				<td colspn="2" width="100%" align="center"><a href="http://hellenicresearchcenter.org/" target="_blank">
				<img class="img-responsive" src="./css/images/logo.png" alt="logo" title="AMPHRC Website" /></a>
				</td>
			</tr>
			<tr>
			<td>
				<button type="button" class="btn btn-default btn-md">
				<a href="./home.php"><span class="glyphicon glyphicon-home text-success"></span></a>
				</button>
			</td>
			<td>
				<button type="button" class="btn btn-default btn-md">
				<a href="./help.html"><span class="glyphicon glyphicon-info-sign text-warning"></span></a>
				</button>
			</td>
			</tr>
	</table>
	</div>
	</div>
	<div class="content marginTable" align="center" v-align="middle">
		<table border="0px" width="80%" valign="top" style="padding: 20px 20px 20px 20px;">
		<tr>
			<td><h3><?php
	
include("config.php");
if (isset($_GET['publication_id']) && is_numeric($_GET['publication_id']) && $_GET['publication_id'] > 0) {
	$publication_id=$_GET['publication_id'];

$result = mysqli_query($conn, "SELECT title FROM amphrc_library.publications where publication_id=$publication_id");
	while($row = mysqli_fetch_array($result)) {
		echo $row['title'];
	}
			
			?> <small><br />Additional information for this resource can be found at the following links</small></h3></td>
		</tr>
		<tr>
		<td>
<?php

echo '<table boreder="0px" class="table table-hover">';
echo "<thead><th>URL ID</th><th>URL</th></thead>";
echo "<tbody>";
	$result = mysqli_query($conn, "SELECT url_id, url FROM amphrc_library.url where publication_id=$publication_id");
	while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>".$row['url_id']."</td>";
		echo "<td><a href=\"".$row['url']."\" target=\"_blank\">".$row['url']."</a></td>";
		echo "</tr>";
	}
echo "</tbody>";
echo "</table>";
	
}
?>
		</td>
		</tr>
		</table>
	</div>
</div>
</body>
</html>