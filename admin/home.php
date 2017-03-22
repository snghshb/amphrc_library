<?php
	include("config.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $emailAddress = mysqli_real_escape_string($db,$_POST['emailAddress']);
      $password = mysqli_real_escape_string($db,$_POST['password']); 
      
	  $sql = "SELECT admin_id FROM admin WHERE emailAddress = '$emailAddress' and passcode = '$password'";
      $result = mysqli_query($db,$sql);
	  if (!$result) {
		printf("Error: %s\n", mysqli_error($sql));
		exit();
		}
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
	
	$count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("emailAddress");
         $_SESSION['login_user'] = $emailAddress;
         
         header("location: landingpage.php");
      }
	  else {
         $error = "Your Login Name or Password is invalid";
      }
   }
	
?>
<html>
	<title>Administrator Login page</title>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	</head>
	<body>
		<div align="center">
		<form action="" method ="post">
			<table class="style1">
				<tr>
				<td colspan="2">ADMNISTRATOR LOGIN PAGE</td>
				</tr>
				<tr>
				<td>Email address</td>
				<td><input type = "text" name = "emailAddress"/></td>
				</tr>
				<tr>
				<td>Password</td>
				<td><input type = "password" name = "password"/></td>
				</tr>
				<tr>
				<td colspan="2">
				<input type = "submit" value = " Submit "/>
				</td>
				</tr>
			</table>
		</form>
		</div>
	</body>
</html>