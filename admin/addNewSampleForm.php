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
	<title>Administrator - Landing Page</title>
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
      $("#includeFooter").load("footer.html"); 
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
	<h4>Insert a sample document for a publication</h4>
	<p>Sample documents are a small peak into the publication. Do make sure that it is not a large document.
	<br />Preferred files are .JPG, .PNG. For .PDF files please make sure you watermark SAMPLE on the pages.</p>
	<hr />
	<form class="form-horizontal" action="insertSample.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label  class="control-label col-sm-2" for="sel1">Select Publication</label>
		<div class="col-sm-10">
		<select class="form-control" id="publication_id" name="publication_id">
<?php
include('config.php');
$sql = "SELECT publication_id, title from amphrc_library.publications";
$result = mysqli_query($conn,$sql);
while($row = $result->fetch_assoc()) {
	echo "<option value='".$row['publication_id']."'>".$row['title']."</option>";
}
?>
		</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2"  for="sampleToUpload" name="sampleToUpload">Sample File Location</label>
		<div class="col-sm-offset-2 col-sm-10">
			<input type="file" name="sampleToUpload" id="sampleToUpload">
		</div>
	</div>
	<div class="form-group"> 
		<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-default">UPLOAD SAMPLE</button>
		</div>
	</div>
	</form>
	</td>
	</tr>
	</table>
</div>
<div id="includeFooter"></div>
</div>
</body>
</html>
<?php
echo "addNewSampleForm.php";
?>
<?php
$conn->close();
}
?>