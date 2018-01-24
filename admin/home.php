<?php
	
	include("config.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $emailAddress = mysqli_real_escape_string($conn,$_POST['emailAddress']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      
	  $sql = "SELECT admin_id FROM admin WHERE emailAddress = '$emailAddress' and password = '$password';";
      $result = mysqli_query($conn,$sql);
	  if (!mysqli_ping($conn)) {
		echo 'Lost connection, exiting';
		exit;
		}
	  if (!$result) {
		print($sql);
		printf("Error: %s\n", mysqli_error($sql));
		exit();
		}
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
	
	$count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("emailAddress");
         $_SESSION['login_user'] = $emailAddress;
         
         header("location: landingpage.php");
      }
	  else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--meta http-equiv="X-UA-Compatible" content="IE=edge"-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<title>Administrator - Login</title>
	</head>
<body>
<div class="wrapper">
<div class="container full-width-div">
	<div class="page-header" align="center">
	<table>
			<tr>
				<td colspn="2" width="100%" align="center"><a href="http://hellenicresearchcenter.org/" target="_blank">
				<img class="img-responsive" src="../css/images/logo.png" alt="logo" title="AMPHRC Website" /></a>
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
				<a href="../home.php" target="_blank"><span class="glyphicon glyphicon-send text-warning"></span></a>
				</button>
			</td>
			</tr>
	</table>
	</div>
</div>
<div class="content" align="center">
<table border="0px" width="80%" height="400px" class="marginTable">
	<tr>
	<td align="center">
	<form action="" method ="post">
	<table class="loginForm">
		<tr>
			<td><h3>ADMINISTRATOR LOGIN PAGE</h3><hr /></td>
		</tr>
		<tr> 
		<td>
		<div class="form-group">
			<label for="emailAddress">EMAIL ADDRESS</label>
			<input type="email" class="form-control" id="emailAddress" name="emailAddress">
		</div>
		</td>
		</tr>
		<tr> 
		<td>
		<div class="form-group">
			<label for="password">PASSWORD</label>
			<input type="password" class="form-control" id="password" name="password">
		</div>
		</td>
		</tr>
		<tr> 
		<td align="center">
			<hr /><button type="submit" class="btn btn-default">SUBMIT</button>
		</td>
		</tr>
	</table>
	</form>
	</td>
	</tr>
</table>
</div>
<footer class="footer">
	<div class="disclaimer">
		<small>Asia Minor and Pontos Hellenic Research Center Inc © 2017 All Rights Reserved.</small>
	</div>
</footer>
</div>
</body>
</html>