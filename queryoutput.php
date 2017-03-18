<?php
	#echo "query results will display here\n";

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "librarydummy";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error)	{
		die("Connection failed: ".$conn->connect_error);
	}

	$sql = "SELECT * FROM repository WHERE 
		name = '".$_POST["searchTerms"]."'";
	
	#$sql = "SELECT * FROM repository";
	
	
	$result = $conn->query($sql);
	
	if($result->num_rows > 0)	{
		echo "<table border=\"1px\"><tr><th>ID</th><th>File Name</th><th>Tag</th><th>Attachment</th></tr>";
		
		while ($row = $result->fetch_assoc())	{
			echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["tag"]."</td><td>".$row["attachment"]."</td></tr>";
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