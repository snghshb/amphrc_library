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
	<title><?php echo $_POST['searchTerms']." - AMPHRC results"; ?></title>
	<script> 
    $(function(){
      $("#includeFooter").load("footer2.html"); 
    });
    </script>
	<script>
	$(function(){
		$("#includeDirections").load("directionAMPHRC.html"); 
    });
	</script>
	<script>
	$(function(){
		$("#includeDirections2").load("directionAMPHRC2.html"); 
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
	<div class="content" align="center">
<?php
	#echo "query results will display here\n";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "amphrc_library";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error)	{
		die("Connection failed: ".$conn->connect_error);
		}
	
	//final search
	$searchTerms = explode(' ',$_POST['searchTerms']);
	$searchTermBits = array();
    foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits[] = "keyword.keyword LIKE '%$term%'";
    }
}
    
//expanded search to include all relevant 
    /* $sql ="select publication_id, publications.title, publications.availability_id from publications where publications.publication_id in (
        select publication_keyword.publication_id from publication_keyword where publication_keyword.keyword_id in (
        select keyword.keyword_id from keyword where ".implode(' OR ', $searchTermBits)."))";
 */

	
	
//expannformationd search to include all relevant 
	#$sql = "select publication_id, publications.title, publications.availability_id from publications where publications.publication_id in (
	#select publication_keyword.publication_id from publication_keyword where publication_keyword.keyword_id in (
	#	select keyword.keyword_id from keyword where keyword.keyword = '".$_POST["searchTerms"]."'))";
	
	#select publications.title from publications where publications.publication_id in (
	#select publication_keyword.publication_id from publication_keyword where publication_keyword.keyword_id in (
	#	select keyword.keyword_id from keyword where keyword.keyword ="Byzantine"
	#));
	
	#$sql = "SELECT * FROM repository WHERE 
	#	name = '".$_POST["searchTerms"]."'";
	
	#$sql = "SELECT * FROM repository";
	
	$sql = "SELECT publication_id, publications.title, publications.availability_id from publications";

	$result = $conn->query($sql);
	
	if($result->num_rows > 0)	{
		echo "<table border=\"0px\" width=\"80%\" height=\"400px\" class=\"marginTable\">";
		echo "<tr><td><h4>AMPHRC Library - search results for keyword(s):";
		foreach ($searchTerms as $term) {
			if (!empty($term)) {
				echo "<kbd>".$term."</kbd> ";
			}
		}
		echo "</h4></td></tr><tr><td width=\"80%\" valign=\"top\"><div class=\"content\" align=\"center\">";
		echo "<table class=\"table table-hover\"><thead><tr><th width=\"65%\">Resource Document</th><th>Access Document</th>";
		echo "<th>Information</th></tr></thead><tbody>";
		
		while ($row = $result->fetch_assoc())	{
			$id = $row["availability_id"];
			echo "<tr><td>".$row["title"]."</td><td>";
			if ($id == 3) {
			?>
			<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">ACCESS WITH PARTNER WEBSITE</button>
			<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo $row["title"]; ?>
				<small><br />Additional information for this resource can be found at the following links</small>
				</h4>
			</div>
			<div class="modal-body">
<?php

echo "<table boreder=\"0px\" class=\"table table-hover\">";
echo "<thead><th>URL(s)</th></thead>";
echo "<tbody>";
	$result5 = mysqli_query($conn, "SELECT url_id, url FROM amphrc_library.url where publication_id='".$row["publication_id"]."'");
	while($row5 = mysqli_fetch_array($result5)) {
		echo "<tr>";
		//echo "<td>".$row5['url_id']."</td>";
		echo "<td><a href=\"".$row5['url']."\" target=\"_blank\">".$row5['url']."</a></td>";
		echo "</tr>";
	}
echo "</tbody>";
echo "</table>";
echo "<hr />";
?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
			</div>
			</div>
			</div>
			</div>
			<?php
			}
			if ($id == 1) {
				?>
			<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal1">DIRECTIONS TO LIBRARY</button>
			<div id="myModal1" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo $row["title"]; ?>
				<small><br />This resource can be found at our on premise library</small>
				</h4>
			</div>
			<div class="modal-body">
				<div id="includeDirections"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
			</div>
			</div>
			</div>
			</div>
				<?php
			}
				//echo "<button type=\"button\" class=\"btn btn-warning btn-xs\"><a href=\"./directionAMPHRC.html\" target=\"_blank\">DIRECTIONS</a></button>";
			if ($id == 0){
				$sql1 = "SELECT file_location FROM amphrc_library.file_location where publication_id =".$row["publication_id"];
				$result1 = $conn->query($sql1);
				if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_assoc()) {
						echo "<button type=\"button\" class=\"btn btn-success btn-xs\"><a href=\"./admin".$row1["file_location"]."\" target=\"_blank\">DOWNLOAD FILE</a></button>";
						#echo $row1["file_location"];
					}
				}
			}
			if ($id == 2){
				?>
				<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal2">ACCESS FILE</button>
				<div id="myModal2" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><?php echo $row["title"]; ?>
					<small><br />This resource can be downloaded here and can be found at our on premise library</small>
					</h4>
				</div>
				<div class="modal-body">
				<?php
				$sql2 = "SELECT file_location FROM amphrc_library.file_location where publication_id =".$row["publication_id"];
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
					while($row2 = $result2->fetch_assoc()) {
						echo "<a href=\"./admin".$row2["file_location"]."\" target=\"_blank\">DOWNLOAD FILE</a><br /><br />- OR -<br /><br />";
						#echo $row1["file_location"];
					}
				}
				?>
				<div id="includeDirections2"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
				</div>
				</div>
				</div>
				</div>
			<?php	
			}
				
			echo "</td>";
			echo "<td>";
			echo "<a href=\"userViewAllDetails.php?publication_id=". $row["publication_id"] ."\" target=\"_blank\">";
			echo "<img src=\"./css/images/view.png\" alt=\"edit\" class=\"icon\" title=\"FileView\" /></a></td>";
		}
		echo "</tr></tbody></table>";
		echo "<br /><br /><a href=\"./home.php\"><button  class=\"btn btn-info\">NEW SEARCH</button></a>";
	}
	else	{
?>
	<table class="marginTable">
	<tr>
	<td>
		<h1>We are sorry :(</h1>
		<p><br />
		<div class="alert alert-danger">
			<strong>But, </strong><kbd><?php echo $_POST['searchTerms'];?></kbd> <strong>did not yield any search results.</strong>
		</div>
		<div class="alert alert-info">
			<a href="./home.php"><button  class="btn btn-info">TRY A NEW SEARCH</button></a>
			<strong>Make sure you have entered the search criteria correctly and always check for spelling mistakes.</strong>
		</div>
		<div class="alert alert-success">
			<a href="https://www.google.com/#q=<?php echo $_POST['searchTerms'];?>" target="_blank"><button  class="btn btn-success">GOOGLE </button></a>
			<strong> search with </strong><kbd><?php echo $_POST['searchTerms'];?></kbd><strong> instead?</strong> 
		</div> 
	</td>
	</tr>
	</table>
<?php	
}

	#
	#if($conn->query($sql) === TRUE)	{
	#	echo "\nNew search query recorded";
	#}
	#else	{
	#	echo "Error: ".$sql."<br />".$conn->error;
	#}
	$conn->close();
	
	
?>
							</div>
			</td>
			</tr><tr>
			<td><p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p></td>
			</tr>
			<tr>
			<td><div id="includeFooter"></div></td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>