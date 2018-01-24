<?php
include('config.php');
include ('session.php');
	//function renderForm($publication_id, $publication_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
if(isset($_GET['keyword_id']) && is_numeric($_GET['keyword_id'])){
	
	$keyword_id=$_GET['keyword_id'];

	$result = mysqli_query($conn, "SELECT * FROM publication_keyword where keyword_id = '$keyword_id'");
	if(mysqli_num_rows($result)==0){
		
		$midResult = mysqli_query($conn,"SELECT keyword FROM keyword where keyword_id = '$keyword_id'");
		
		while($row = mysqli_fetch_array($midResult)) 
		{
			$keyword_name = $row['keyword'];
			//echo $category_name;
		}
		if (!$midResult) {
    printf("Error: %s\n", mysqli_error($conn));
    //exit();
}

		mysqli_query($conn, "DELETE FROM keyword Where keyword_id= '$keyword_id'");
		
		$sql_log = "INSERT INTO amphrc_library.admin_log (admin_id, action) VALUES (".ADMIN_ID.", 'Deleted keyword $keyword_name, keyword_id $keyword_id')";
	
		if(mysqli_query($conn, $sql_log)){
		
			header("Location: keywordOption.php");
	}
		
}
else
{
	echo "value not passed";

}
}
?>	
<?php
$conn->close();
}
?>