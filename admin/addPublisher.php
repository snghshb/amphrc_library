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
	<title>Administrator - Add New Publisher</title>
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
	<table border="0px" width="80%" class="marginTable" valign="top">
	<tr>
	<td><h3>Add a New Publisher</h3><hr /></td>
	</tr>
	<tr>
	<td valign="top">
	<form class="form-horizontal" action="insertPublisher.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label col-sm-2" for="newPublisherName">New Publisher Name</label>
			<div class="col-sm-10">
			<input type="newPublisherName" class="form-control" id="newPublisherName" name="newPublisherName" placeholder="Enter Publisher name..">
			</div>
		</div>
		<p>Enter Publisher location</p>
		<div class="form-group">
			<label class="control-label col-sm-2" for="city">City</label>
			<div class="col-sm-10">
			<input type="city" class="form-control" id="city" name="city" placeholder="Enter city..">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="state">State</label>
			<div class="col-sm-10">
			<input type="state" class="form-control" id="state" name="state" placeholder="State">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="country">Country</label>
			<div class="col-sm-10">
			<input type="country" class="form-control" id="country" name="country" placeholder="Country">
			</div>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
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
$conn->close();
}
?>