<?php
session_start();
unset($_SESSION['login_user']);        
unset($_SESSION["password"]);
   
session_destroy();

//header("Location: ../admin/home.php");
//exit;

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
<div class="content" align="center">
	<table border="0px" width="80%" height="400px" class="marginTable">
	<tr>
	<td valign="top" align="center">
		<div class="alert alert-danger">
			<strong>YOU HAVE BEEN SUCCESSFULLY LOGGED OUT</strong>
		</div>
		<div class="alert alert-info">
			<a href="./home.php"><button  class="btn btn-info">LOGIN AGAIN</button></a>
			<a href="../home.php"><button  class="btn btn-info">ACCESS USER HOME</button></a>
		</div>
	</td>
	</tr>
	</table>
</div>
<div id="includeFooter"></div>
</body>
</html>