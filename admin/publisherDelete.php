<?php
include('config.php');
include ('session.php');

if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
	if(isset($_GET['publisher_id']) && is_numeric($_GET['publisher_id'])){
		$publisher_id=$_GET['publisher_id'];
		
		$result = mysqli_query($conn, "SELECT * FROM publication_publisher where publisher_id = '$publisher_id'");
		
		if(mysqli_num_rows($result)==0) {
			mysqli_query($conn, "DELETE FROM publisher Where publisher_id='$publisher_id'");
			$last_id = $conn->insert_id;
			$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Deleted a publisher with id $last_id')";
			if(mysqli_query($conn, $sql_log))	{}
		}
		
		$query= "SELECT * FROM publications_publisher where publisher_id = '$publisher_id'";

		header("Location: ./publisherOption.php");
	}
	else {
		header("Location: ./publisherOption.php?message=fail");
	}
	$conn->close();
}
?>