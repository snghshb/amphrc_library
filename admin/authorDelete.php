<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
?>
<?php

include('config.php');

if(isset($_GET['author_id']) && is_numeric($_GET['author_id'])){
	
	$author_id=$_GET['author_id'];

	$result = mysqli_query($conn, "SELECT * FROM publication_author where author_id = '$author_id'");
	
	if(mysqli_num_rows($result)==0){
		
		
		$midResult = mysqli_query($conn, "SELECT * FROM author where author_id = '$author_id'");
		while($row = mysqli_fetch_array($midResult)) 
		{
			$author_first_name = $row['author_first_name'];
			$author_last_name = $row['author_last_name'];
			
		}
		
		mysqli_query($conn, "DELETE FROM author Where author_id='$author_id'");
		
		$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Deleted author \"$author_first_name \" \"$author_last_name \", author_id $author_id')";
	
		if(mysqli_query($conn, $sql_log)){
			#sleep(2);
		
		header("Location: ./authorOption.php");
	}} 
	else {
		header("Location: ./authorOption.php?message=fail");
	}

}
else
{
	echo "value not passed";

}
?>
<?php
$conn->close();
}
?>