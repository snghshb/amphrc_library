<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
?>
<?php

include('config.php');
include('session.php');

if(isset($_GET['sample_id']) && is_numeric($_GET['sample_id'])){
	
	$sample_id=$_GET['sample_id'];

	$result = mysqli_query($conn, "SELECT * FROM publication_sample where sample_id = '$sample_id'");
	if(mysqli_num_rows($result))
	{
		$midResult = mysqli_query($conn, "SELECT sample_id FROM publication_sample where sample_id = '$sample_id'");
		while($row = mysqli_fetch_array($midResult)) 
		{
			$publication_id = $row['publication_id'];
			//echo $category_name;
		}
		
		mysqli_query($conn, "DELETE FROM publication_sample Where sample_id='$sample_id'");
		
		$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Deleted sample \"$sample_id\", for publication $publication_id')";
	
		if(mysqli_query($conn, $sql_log)){
			//sleep(7);
			header("Location: editSampleForm.php");
	}
	
		
	} 
	else {
		echo "there is some error";
		header("Location: ./editSampleForm.php?message=fail");
	}

}
else
{
	echo "value not passed";
	//header("Location: view.php");
}
?>
<?php
$conn->close();
}
?>