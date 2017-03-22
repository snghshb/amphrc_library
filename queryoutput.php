<html>
	<title>User - Output</title>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	</head>
	<body>
		<div align="center">
			<table class="style1">
				<tr>
					<td><a href="http://hellenicresearchcenter.org/" target="_blank"><img src="images/logo.png" alt="logo"  title="AMPHRC Website" /></a></td>
				</tr>
				<tr>
					<td>
						<table class="style2">
						<tr>
							<td>
							<a href="./home.html"><img src="images/home.png" alt="home" class="icon" title="Library Home" /></a>
							</td>
							<td align ="right">
							<a href="./help.html" target="_blank"><img src="images/info.png" alt="information" class="icon"  title="Help/Information"/></a>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="contentDiv" align="center">
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

	$sql = "select publications.title, publications.availability_id from publications where publications.publication_id in (
	select publication_keyword.publication_id from publication_keyword where publication_keyword.keyword_id in (
		select keyword.keyword_id from keyword where keyword.keyword = '".$_POST["searchTerms"]."'))";
	
	#select publications.title from publications where publications.publication_id in (
	#select publication_keyword.publication_id from publication_keyword where publication_keyword.keyword_id in (
	#	select keyword.keyword_id from keyword where keyword.keyword ="Byzantine"
	#));
	
	#$sql = "SELECT * FROM repository WHERE 
	#	name = '".$_POST["searchTerms"]."'";
	
	#$sql = "SELECT * FROM repository";
	
	
	$result = $conn->query($sql);
	
	if($result->num_rows > 0)	{
		echo "<table border=\"0px\"><tr><th>File Name</th><th>Availability ID</th></tr>";
		
		while ($row = $result->fetch_assoc())	{
			echo "<tr><td>".$row["title"]."</td><td align=\"center\">".$row["availability_id"]."</td></tr>";
		}
		echo "</table>";
	}
	else	{
		echo "No results returned";
	}
		
	
	#
	#if($conn->query($sql) === TRUE)	{
	#	echo "\nNew search query recorded";
	#}
	#else	{
	#	echo "Error: ".$sql."<br />".$conn->error;
	#}

	$conn->close();

	
	echo "<button onclick=\"history.go(-1);\">Back </button>";

?>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="disclaimer">Asia Minor and Pontos Hellenic Research Center Inc © 2017 All Rights Reserved.</td>
						</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
