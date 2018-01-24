<?php
include ('config.php');

function renderForm($publication_id, $category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publisher_city, $publisher_state, $publisher_country, $publish_year, $start_year, $end_year, $volume, $description, $tags, $error,$conn){
?>

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
	<link rel="stylesheet" href="../css/custom.css">
	<title>Administrator - Edit Publications</title>
	<script> 
    $(function(){
      $("#includeHeader").load("header.html"); 
    });
    </script>
	<script> 
    $(function(){
      $("#includeNavbar").load("navbar.html"); 
    });
    </script>
	<script> 
    $(function(){
      $("#includeFooter").load("footer2.html"); 
    });
    </script>
</head>
<body>
<div class="wrapper">
<div id="includeHeader"></div>
<div id="includeNavbar"></div>
<div class="content" align="center">
	<table border="0px" width="80%" height="400px" class="marginTable">
	<tr>
	<td valign="top">
	<h3>Edit Publication: <?php echo $title; ?></h3>
	<hr />
<?php
								// if there are any errors, display them
	

  
								if ($error != '')

								{

								echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

								}
							

?>
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="publication_id" value="<?php echo $publication_id; ?>"/>
								<table class="table table-striped" width="80%" border="1px">							
								<tr>
								<td>Enter Category *</td>
								<td><select name = 'category_name'>
<?php
										echo "<option value = '$category_name' selected = 'selected' >$category_name</option>";
										$sql = "Select category_name from category where category_name != '$category_name' order by category_name asc";
										$result = mysqli_query($conn, $sql);
										while ($row = mysqli_fetch_array($result)){
											echo "<option value = '".$row['category_name']."'>".$row['category_name']."</option>";
										}
?>
								</select></td>
								</tr>
								<tr>
								<td>Enter Title *</td> 
								<td><input type="text" name="title" value="<?php echo $title; ?>" /></td>
								</tr>
								<tr>
								<td>Enter Author First Name</td>
								<td><input type="text" name="author_first_name" value="<?php echo $author_first_name; ?>" />
								</tr>
								<td>Enter Author Last Name</td>
								<td><input type="text" name="author_last_name" value="<?php echo $author_last_name; ?>" />
								</tr>
								<tr>
								<td>Enter ISBN</td> 
								<td><input type="text" name="isbn" value="<?php echo $isbn; ?>" /></td>
								</tr>
								<tr>
								<td>Enter Publisher Name</td> 
								<td><select name = 'publisher_name'>
<?php
										echo "<option value = '$publisher_name' selected = 'selected'>$publisher_name</option>";
										$sql = "Select publisher_name from publisher where publisher_name != '$publisher_name' order by publisher_name asc";
										$result = mysqli_query($conn, $sql);
										while ($row = mysqli_fetch_array($result)){
										echo "<option value='" . $row['publisher_name'] . "'>".$row['publisher_name']."</option>";
										}
?>
								</select></td>
								</tr>
								<tr>
								<td>Enter Publish Year</td> 
								<td><input type="text" name="publish_year" value="<?php echo $publish_year; ?>" /></td>
								</tr>
								<tr>
								<td>Enter Start Year</td> 
								<td><input type="text" name="start_year" value="<?php echo $start_year; ?>" /></td>
								</tr>
								<tr>
								<td>Enter End Year</td> 
								<td><input type="text" name="end_year" value="<?php echo $end_year; ?>" /></td>
								</tr>
								<tr>
								<td>Enter Volume</td>
								<td><input type="text" name="volume" value="<?php echo $volume; ?>" /></td>
								</tr>
								<tr>
								<td>Enter Description</td>
								<td><input type="text" name="description" value="<?php echo $description; ?>" /></td>
								</tr>
								<tr>
								<td>Tags (one per line) *</td>
								<td><textarea type="text" name="tags"  cols="40" rows="7" ><?php echo implode("\n", $tags);?></textarea></td>
								</tr>
								<tr>
								<td colspan="2">* required</td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Record" name="submit"></td>
								</tr>
								</table>
						</form>
				</div>
				</td>
					</td>
	</tr>
	<tr><td><p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> 
	</td>
	</tr>
	<tr><td><div id="includeFooter"></div>
	</td>
	</tr>
	</table>
</div>
</div>
</body>
</html>

<?php
}
if(isset($_POST['submit'])){
	$publication_id = $_POST['publication_id'];
	$category_name = $_POST['category_name'];
	$category_id = '';
	$title = $_POST['title'];
	$author_first_name = $_POST['author_first_name'];
	$author_last_name  = $_POST['author_last_name'];
	$author_id = '';
	$isbn = $_POST['isbn'];
	$publisher_name = $_POST['publisher_name'];
	$publish_year = $_POST['publish_year'];
	$start_year = $_POST['start_year'];
	$end_year = $_POST['end_year'];
	$volume  = $_POST['volume'];
	$description  = $_POST['description'];
	$taginput = isset($_POST['tags'])?$_POST['tags']:"";
	$tags = explode("\n", str_replace("\r", "", $taginput));
				if(!isset($tags) || empty($tags)){
					$error = "No Tags Given";
				}
	if(!isset($category_name) || $category_name == ''){
		$error = "Please input the category name";
		renderForm($publication_id,'',$title,$author_first_name,$author_last_name,$isbn,$publisher_name,$publisher_city,$publisher_state,$publisher_country,$publish_year,$start_year,$end_year,$volume, $description,$tags,$error,$conn);
	}else{
		if(!isset($title) || $title == ''){
			$error = "Please input the title";
			renderForm($publication_id,$category_name,'',$author_first_name,$author_last_name,$isbn,$publisher_name,$publisher_city,$publisher_state,$publisher_country,$publish_year,$start_year,$end_year,$volume, $description,$tags,$error,$conn);
		}else{
			if(!isset($tags) || $tags == ''){
				$error = "Please input at least one tag";
				renderForm($publication_id,$category_name,$title,$author_first_name,$author_last_name,$isbn,$publisher_name,$publisher_city,$publisher_state,$publisher_country,$publish_year,$start_year,$end_year,$volume, $description,'',$error,$conn);
			}else{
				$result = mysqli_query($conn, "SELECT * from category where upper(category_name)=upper('$category_name')");			
						
				if(mysqli_num_rows($result)==0){
					mysqli_query($conn, "insert into category (category_name) values ('$category_name')");
					$result = mysqli_query($conn, "select * from category where category_name = upper('$category_name')");
					while($row = mysqli_fetch_array($result)) {
						$category_id = $row['category_id'];
					}
				}
				else{
					while($row = mysqli_fetch_array($result)) {
						$category_id = $row['category_id'];
					}
				}
				if(empty($author_first_name) && $author_last_name){
					mysqli_query($conn, "Delete * FROM publication_author WHERE publication_id = '$publication_id'");
					
					}else{
					if(!empty($author_last_name) || !empty($author_first_name)){
						$result = mysqli_query($conn, "SELECT * from author where upper(author_first_name)=upper('$author_first_name') and upper(author_last_name)=upper('$author_last_name')");
						if(mysqli_num_rows($result)==0){
							mysqli_query($conn, "insert into author (author_first_name, author_last_name ) values ('$author_first_name','$author_last_name')");
							$result = mysqli_query($conn, "SELECT * from author where upper(author_first_name)=upper('$author_first_name') and upper(author_last_name)=upper('$author_last_name')");
							while($row = mysqli_fetch_array($result)) {
							$author_id = $row['author_id'];
							}
						}
						else{
							while($row = mysqli_fetch_array($result)) {
							$author_id = $row['author_id'];
							}
						}
						mysqli_query($conn, "Update publication_author set author_id = '$author_id' where publication_id = '$publication_id'");
					}
				}
				if(empty($publisher_name)){
					mysqli_query($conn, "Delete * FROM publication_publisher WHERE publication_id = '$publication_id'");

				}else{
					//echo "Publisher Name: ".$publisher_name;
					$result = mysqli_query($conn, "SELECT * FROM `publisher` WHERE upper(publisher_name) = upper('$publisher_name')");
					if(mysqli_num_rows($result)==0){
						mysqli_query($conn, "insert into publisher (publisher_name, city , `state/province`, country)values ('$publisher_name','$publisher_city','$publisher_state','$publisher_country')");
					//	echo "publisher info passed";
						$result = mysqli_query($conn, "SELECT * FROM `publisher` WHERE upper(publisher_name) = upper('$publisher_name') and upper(city) = upper('$publisher_city') and upper(`state/province`) = upper('$publisher_state') and upper(country) = upper('$publisher_country')");
						while($row = mysqli_fetch_array($result)) {
						$publisher_id = $row['publisher_id'];
					//echo "publisher id after insert into : ".$publisher_id;
					}
					}
					else{
						while($row = mysqli_fetch_array($result)) {
						$publisher_id = $row['publisher_id'];
						}
					}
					mysqli_query($conn, "Update publication_publisher set publisher_id = '$publisher_id' where publication_id = '$publication_id'");
				}	
				mysqli_query($conn, "Delete FROM publication_keyword WHERE publication_id = '$publication_id'");
				
				foreach ($tags as $value){
							//echo $value." ";
							$result = mysqli_query($conn, "SELECT * from keyword where upper(keyword)=upper('$value')");
							if(mysqli_num_rows($result)==0){
								mysqli_query($conn, "insert into keyword (keyword) values ('$value')");
								
								}
						}
				foreach ($tags as $value){
					$result = mysqli_query($conn, "SELECT * from keyword where upper(keyword)=upper('$value')");
					//echo "keyword id: ";
						while($row = mysqli_fetch_array($result)) {
							$keyword_id = $row['keyword_id'];
							//echo $keyword_id. " ";
							
							mysqli_query($conn, "insert into publication_keyword (publication_id, keyword_id) values ('$publication_id', '$keyword_id')");
						}
					}
				$sql = "Update publications set category_id = '$category_id', title = '$title', isbn = '$isbn', publish_year = '$publish_year', start_year = '$start_year', end_year = '$end_year', volume = '$volume', description = '$description' where publication_id = '$publication_id'";
				//echo $sql;
				mysqli_query($conn, $sql);
				header('Location: searchPublications.php');
				
			} //end tags check
		
		} //end title check
		
	} //end category check

						
	
}else{
	
$publication_id = $_GET['publication_id'];


			$result = mysqli_query($conn, "SELECT * FROM publications WHERE publication_id=$publication_id");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$category_id = $row['category_id'];
				$title = $row['title'];
				$isbn = $row['isbn'];
				$publish_year = $row['publish_year'];
				$start_year = $row['start_year'];
				$end_year = $row['end_year'];
				$volume = $row['volume'];
				$description = $row['description'];
				//$availability_id = $row['availability_id'];
				//echo $availability_id;
				//renderForm($publication_id,$category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, '');
			} 
			else 
			{
				echo "No results";
			}
			$result = mysqli_query($conn, "SELECT * from category where category_id = '$category_id'");
			$row = mysqli_fetch_array($result);
			if($row){
				$category_name = $row['category_name'];
			}
			$author_first_name ='';
			$author_last_name = '';
			$result = mysqli_query($conn, "SELECT * from author where author_id = (select author_id from publication_author where publication_id = '$publication_id')");
			$row = mysqli_fetch_array($result);
			if($row){
				$author_first_name = $row['author_first_name'];
				$author_last_name = $row['author_last_name'];
			}
			$publisher_name = '';
				$publisher_city = '';
				$publisher_state = '';
				$publisher_country = '';
			$result = mysqli_query($conn, "SELECT * from publisher where publisher_id = (select publisher_id from publication_publisher where publication_id = '$publication_id')");
			$row = mysqli_fetch_array($result);
			if($row){
				$publisher_name = $row['publisher_name'];
				$publisher_city = $row['city'];
				$publisher_state = $row['state/province'];
				$publisher_country = $row['country'];
				
			}
			$result = mysqli_query($conn, "SELECT * from keyword where keyword_id in (select keyword_id from publication_keyword where publication_id = '$publication_id')");

			$tags = array();
			$tagsString = "";
			while(($row = mysqli_fetch_assoc($result))){
				$tags[] = $row['keyword'];
				$tagsString = $tagsString."\n".$row['keyword'];
				
				
			}
//echo "Select category_name from category order by category_name asc";
renderForm($publication_id,$category_name,$title,$author_first_name,$author_last_name,$isbn,$publisher_name,$publisher_city,$publisher_state,$publisher_country,$publish_year,$start_year,$end_year,$volume, $description,$tags,'',$conn);
}
?>