<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
?>
<?php

include('config.php');

if(isset($_GET['publication_id']) && is_numeric($_GET['publication_id'])){
	
$publication_id=$_GET['publication_id'];


$result = mysqli_query($conn, "DELETE FROM file_location Where publication_id=$publication_id");
$result = mysqli_query($conn, "DELETE FROM url Where publication_id=$publication_id");
$result = mysqli_query($conn, "DELETE FROM publication_publisher Where publication_id=$publication_id");
$result = mysqli_query($conn, "DELETE FROM publication_author Where publication_id=$publication_id");
$result = mysqli_query($conn, "DELETE FROM publication_keyword Where publication_id=$publication_id");
$result = mysqli_query($conn, "DELETE FROM publications Where publication_id=$publication_id");


header("Location:confirmDelete.php");
}
else
{
	header("Location: viewExisting.php");
}
?>
<?php
$conn->close();
}
?>