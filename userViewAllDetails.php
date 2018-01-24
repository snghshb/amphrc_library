<?php
	
	include("config.php");
	
	//function renderForm($publication_id, $category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	
	function renderForm($publication_id,$categoryName, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id,$keywordList,$downloadLink,$externalLink,$sample_location, $error)
	{

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--meta http-equiv="X-UA-Compatible" content="IE=edge"-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	<title>
	<?php echo $title." - details";?>
	</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script> 
    $(function(){
      $("#includeFooter").load("footer2.html"); 
    });
    </script>
</head>
<body>
<div class="wrapper">
<div class="container full-width-div">
	<div class="page-header" align="center">
	<table>
			<tr>
				<td colspn="2" width="100%" align="center"><a href="http://hellenicresearchcenter.org/" target="_blank">
				<img class="img-responsive" src="./css/images/logo.png" alt="logo" title="AMPHRC Website" /></a>
				</td>
			</tr>
			<tr>
			<td>
				<button type="button" class="btn btn-default btn-md">
				<a href="./home.php"><span class="glyphicon glyphicon-home text-success"></span></a>
				</button>
			</td>
			<td>
				<button type="button" class="btn btn-default btn-md">
				<a href="./help.html"><span class="glyphicon glyphicon-info-sign text-warning"></span></a>
				</button>
			</td>
			</tr>
	</table>
	</div>
	</div>
	<div class="content" align="center">
			<table border="0px" width="80%" height="400px" class="marginTable">
			<tr>
			<td>
		<table class="table table-striped">							
			<tr>
				<td width="25%" align="right" style="padding-right: 10px;"><strong>Title</strong></td>
				<td colspan="5"><?php echo $title; ?></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 10px;"><strong>Description</strong></td>
				<td colspan="5"><?php echo $description; ?></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 10px;"><strong>Category</strong></td>
				<td width="300px" colspan="5" class="descValue"><?php echo $categoryName; ?></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 10px;"><strong>Publish Year</strong></td>
				<td class="descValue">
				<?php 
				if ($publish_year === '' || $publish_year === NULL || $publish_year === 0)
						echo "NA";
				else echo $publish_year; ?>
				</td>
				<td align="right" style="padding-right: 10px;"><strong>Volume</strong></td>
				<td class="descValue">
				<?php 
				if ($volume === '' || $volume === NULL || $volume === 0)
						echo "NA";
				else echo $volume; ?>
				</td>
				<td align="right" style="padding-right: 10px;"><strong>ISBN</strong></td>
				<td class="descValue">
				<?php 
				if ($isbn === '' || $isbn === NULL || $isbn === 0)
						echo "NA";
				else echo $isbn; ?>
				</td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 10px;"><strong>Start Year</strong></td>
				<td class="descValue">
				<?php 
				if ($start_year === "" || $start_year === NULL || $start_year === 0)
						echo "NA";
				else echo $start_year; ?>
				</td>
				<td align="right" style="padding-right: 10px;"><strong>End Year</strong></td>
				<td colspan="3" class="descValue">
				<?php 
				if ($end_year === "" || $end_year === NULL || $end_year === 0)
						echo "NA";
				else echo $end_year; ?>
				</td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 10px;"><strong>Keywords</strong></td>
				<td colspan="5" class="descValue"><?php echo $keywordList;?></td>
			</tr>
			<tr>
				<td align="right" style="padding-right: 10px;"><strong>Availability Status</strong></td>
				<td colspan="5" class="descValue">
				<?php 
					if ($availability_id === 0)
						echo "0 File available online";
					else if ($availability_id === 1)
						echo "1 Available in on-premise library";
					else if ($availability_id === 2)
						echo "2 Available online and on-premise";
					else echo "3 Available with our partner website";
					 
				?>
				</td>
			</tr>
			<tr>
			<td align="right" style="padding-right: 10px;"><strong>Download Link</strong></td>
			<td colspan="5" class="descValue">
			<?php
			if ($availability_id === 0 || $availability_id === 2)
				echo 'Download Link here';
			echo 'No download link available';
			?>
			</td>
			</tr>
			<tr>
			<td align="right" style="padding-right: 10px;"><strong>External links</strong></td>
			<td colspan="5" class="descValue">
			<?php
			if ($availability_id === 3)
				echo 'External Links here';
			else echo 'No external link available for this file';
			?>
			</td>
			</tr>
			<?php
				if($sample_location != ''){
			?>
			<tr>
			<td colspan="6" align="center">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View Sample</button>
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Sample for <?php echo $title; ?></h4>
							</div>
							<div class="modal-body" align="center">
								<p><!--?php echo $sample_location; ?><hr /-->
								<embed class="responsive" src="./admin<?php echo $sample_location; ?>" width="100%" height="800px"/></embed>
								</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
    				</div>
				</div>
			</td>
			</tr>
			<?php
				}
			?>
			<tr>
			<td><p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> </td>
			</tr>
			<tr>
			<td><div id="includeFooter"></div></td>
			</tr>
		</table>
		</td>
		</tr>
		</table>
		</div>
		</div>
</body>
</html>
<?php
	}

	// check if the form has been submitted. If it has, process the form and save it to the database
	if (isset($_POST['submit']))
	{
		// confirm that the 'id' value is a valid integer before getting the form data
		if (is_numeric($_POST['publication_id']))
		{
			// get form data, making sure it is valid

			//$publication_id = $_POST['publication_id'];
			$publication_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publication_id']));
			$category_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category_id']));
			$title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
			$isbn = mysqli_real_escape_string($conn, htmlspecialchars($_POST['isbn']));
			$publish_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publish_year']));
			$start_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['start_year']));
			$end_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['end_year']));
			$volume = mysqli_real_escape_string($conn, htmlspecialchars($_POST['volume']));
			$description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['description']));
			$availability_id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['availability_id']));
			$categoryName;
			
			/*if ($category_id == '' || $title == '' || $availability_id = '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($publication_id,$category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error);
			} 
			else 
			{
				mysqli_query($conn, "UPDATE publications SET category_id='$category_id', title='$title', isbn='$isbn',publish_year='$publish_year',end_year='$end_year',volume='$volume',description='$description',availability_id='$availability_id' WHERE publication_id='$publication_id'");
				header("Location: viewExisting.php");
			}
		*/
		}
		else 
		{
			echo 'ERROR 1';
		}
	} 
	else 
	{
		// if the form hasn't been submitted, get the data from the db and display the form
		// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
		
		if (isset($_GET['publication_id']) && is_numeric($_GET['publication_id']) && $_GET['publication_id'] > 0)
		{
			// query db
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
				$availability_id = $row['availability_id'];
				$sample_sql = mysqli_query($conn, "SELECT * FROM amphrc_library.publication_sample WHERE publication_id=$publication_id");
				$sample_row = mysqli_fetch_array($sample_sql);
				$sample_location='';
				if($sample_row) {
					$sample_location = $sample_row['sample_location'];
				}
				
			} 
			else 
			{
				echo "No results";
			}
			$result1 = mysqli_query($conn, "SELECT * FROM category WHERE category_id=$category_id");
			$row1 = mysqli_fetch_array($result1);
			if($row1){
				$categoryName = $row1['category_name'];				
			}
			else 
			{
				echo "No results";
			}
			
			$sql2 = "SELECT keyword from amphrc_library.keyword WHERE keyword_id IN (
			SELECT keyword_id from amphrc_library.publication_keyword WHERE publication_id=$publication_id)";
			
			$keywordList = "";
			
			$result2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_array($result2);
			if($row2)
				$keywordList = $keywordList.$row2['keyword']." ";
			
			$downloadLink = '';
			
			if ($availability_id == 0 || $availability_id == 2){
				$sql3 = "SELECT * FROM 	amphrc_library.file_location WHERE publication_id=$publication_id";
				
				$result3 = mysqli_query($conn, $sql3);
				$row3 = mysqli_fetch_array($result3);
				if($row3)
					$downloadLink = '<td colspan="5"><a href="' .$row3['file_location']. '">Download File here</td>';
			}

			$externalLink = '';
			
			if ($availability_id == 3){
				$sql4 = "SELECT * FROM 	amphrc_library.url WHERE publication_id=$publication_id";
				
				$result4 = mysqli_query($conn, $sql4);
				$row4 = mysqli_fetch_array($result4);
				if($row4)
					$externalLink = '<td colspan="5"><a href="' .$row4['url']. '">' .$row4['url']. '</td>';
			}
			
		
			renderForm($publication_id,$categoryName,$title,$isbn,$publish_year,$start_year,$end_year,$volume,$description,$availability_id,$keywordList,$downloadLink,$externalLink,$sample_location,'');
		} 
		else
		{
			echo "ERROR 2";
		}
	}
?>