<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
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
	<title>Administrator - Add new publication</title>
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
	<script>
		function validateForm() {
		var x = document.forms["uploadForm"]["fileTitle"].value;
		if (x == "") {
			alert("File name is mandatory field");
			return false;
		}
		var y = document.forms["uploadForm"]["description"].value;
		if (y == "") {
			alert("File description is mandatory field");
			return false;
		}
	}
	</script>
</head>
<body>
<div class="wrapper">
<div id="includeHeader"></div>
<div id="includeNavbar"></div>
<div class="content" align="center">
	<table border="0px" width="80%" height="400px" class="marginTable">
	<tr>
	<td>
		<h3>Add new Publication</h3>
		</td>
	<td>
		<div align="right">
		<button type="button" class="btn btn-default btn-md"  data-toggle="modal" data-target="#myModal">
			<span class="glyphicon glyphicon-question-sign"></span>
        </button>
		</div>
	
		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Adding new publication</h4>
					</div>
					<div class="modal-body">
						<p>Add all relevant information pertaining to the file. <br /><br />If there is a new Category, Author or Publisher, navigate to the add new Category, Author or Publisher part of the admin console through the admin Navbar before adding the new publication.<br /><br />You can always add a missing keyword.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		</td>
		</tr>
		<tr>
		<td colspan="2">
		<hr />
		<form action="fileupload.php" method="post" name ="uploadForm" onsubmit="return validateForm()" enctype="multipart/form-data" class="form-horizontal">
		<div class="form-group">
			<label class="control-label col-sm-2" for="title" name="title">TITLE</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title...">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="desc">DESCRIPTION</label>
			<div class="col-sm-10"> 
				<textarea type="text" class="form-control" id="desc" name="desc" placeholder="Enter Description"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="sel1">CATEGORY</label>
			<div class="col-sm-10">
			<select class="form-control" id="category_id" name="category_id">
<?php
$sql = "SELECT category_id, category_name from amphrc_library.category";
$result = mysqli_query($conn,$sql);
while($row = $result->fetch_assoc()) {
	echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
}
?>			
			</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="sel2">AUTHOR</label>
			<div class="col-sm-10">
			<select class="form-control" id="author_id" name="author_id">
<?php
$sql1 = "SELECT author_id, author_first_name, author_last_name from amphrc_library.author";
$result1 = mysqli_query($conn,$sql1);
while($row1 = $result1->fetch_assoc()) {
	echo "<option value='".$row1['author_id']."'>".$row1['author_first_name']." ".$row1['author_last_name']."</option>";
}
?>			
			</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="sel3">PUBLISHER</label>
			<div class="col-sm-10">
			<select class="form-control" id="publisher_id" name="publisher_id">
<?php
$sql2 = "SELECT publisher_id, publisher_name, city, country from amphrc_library.publisher";
$result2 = mysqli_query($conn,$sql2);
while($row2 = $result2->fetch_assoc()) {
	echo "<option value='".$row2['publisher_id']."'>".$row2['publisher_name']." (".$row2['city'].", ".$row2['country'].")</option>";
}
?>			
			</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="isbn" name="isbn">RESOURCE ISBN</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN...">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="publish_year" name="publish_year">PUBLISH YEAR</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="publish_year" name="publish_year" placeholder="Enter publish_year...">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="start_year" name="start_year">PERIOD START YEAR</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="start_year" name="start_year" placeholder="Enter start year...">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="end_year" name="end_year">PERIOD END YEAR</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="end_year" name="end_year" placeholder="Enter end year...">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="volume" name="volume">RESOURCE VOLUME</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="volume" name="volume" placeholder="Enter volume...">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="availability_id" name="availability_id">AVAILABILITY ID</label>
			<div class="col-sm-10">
			<select class="form-control" id="availability_id" name="availability_id">
				<option value = '0'>Uploading File to Online Library Only</option>
				<option value = '1'>Available Only On-premise Library</option>
				<option value = '2'>Uploading File and Available On-premise</option>
				<option value = '3'>Available at Partner Website</option>
			</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="fileToUpload" name="fileToUpload">PARTNER URL</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="url" name="url" placeholder="Enter URL...">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="fileToUpload" name="fileToUpload">FILE TO UPLOAD</label>
			<div class="col-sm-10">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<p class="footnote">Allowed file types are PDF, DOC, DOCX, JPG, JPEG, PNGs</p>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="keyword[]" name="keyword[]">KEYWORD LIST<br />(hold shift to select multiple in a row; hold control and click to select multiple)</label>
			<div class="col-sm-10">
			<select multiple class="form-control" id="keyword[]" name="keyword[]">
<?php
$sql3 = "SELECT keyword_id, keyword from amphrc_library.keyword";
$result3 = mysqli_query($conn,$sql3);
while($row3 = $result3->fetch_assoc()) {
	echo "<option value='".$row3['keyword_id']."'>".$row3['keyword']."</option>";
}
?>
			</select>
			</div>
		</div>
		<div class="form-group"> 
			<div align="center">
				<button type="submit" class="btn btn-default">MAKE NEW ENTRY</button>
			</div>
		</div>
		</form>
		<hr />
	
	</td>
	</tr>
	<tr>
	<td><p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> </td>
	</tr>
	<tr>
	<td><div id="includeFooter"></div></td>
	</tr>
	</table>
</div>

</div>
</body>
</html>
<?php
$conn->close();
}
?>