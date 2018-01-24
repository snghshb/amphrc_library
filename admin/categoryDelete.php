<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
?>
<?php

include('config.php');
include('session.php');

if(isset($_GET['category_id']) && is_numeric($_GET['category_id'])){
	
	$category_id=$_GET['category_id'];

	$result = mysqli_query($conn, "SELECT * FROM publications where category_id = '$category_id'");
	if(mysqli_num_rows($result)==0)
	{
		$midResult = mysqli_query($conn, "SELECT category_name FROM category where category_id = '$category_id'");
		while($row = mysqli_fetch_array($midResult)) 
		{
			$category_name = $row['category_name'];
			//echo $category_name;
		}
		
		mysqli_query($conn, "DELETE FROM category Where category_id='$category_id'");
		
		$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Deleted category \"$category_name\", category_id $category_id')";
	
		if(mysqli_query($conn, $sql_log)){
			sleep(7);
			header("Location: categoryOption.php");
	}
	
		
	} 
	else {
		header("Location: ./categoryOption.php?message=fail");
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