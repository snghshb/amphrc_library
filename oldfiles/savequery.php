<?php 
echo $_POST["searchTerms"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarydummy";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error)	{
	die("Connection failed: ".$conn->connect_error);
}

$sql = "INSERT INTO searchqueries (searchquery) 
	VALUES ('".$_POST["searchTerms"]."')";
	
if($conn->query($sql) === TRUE)	{
	echo "\nNew search query recorded";
}
else	{
	echo "Error: ".$sql."<br />".$conn->error;
}

$conn->close();
?>