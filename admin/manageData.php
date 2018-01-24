<?php
include ('config.php');
include ('session.php');
	//function renderForm($publication_id, $publication_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
?>
<html>
<head>
	<title>Administrator - Manage Data</title>
	
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
</head>
<body>
<div align="center">
		<table class="style1">
			<tr>
				<td><a href="./landingpage.php" target="_blank"><img src="../css/images/logo.png" alt="logo"  title="AMPHRC Library Administrator" /></a></td>
			</tr>
			<tr>
			<td>
				<table class="style2">
					<tr>
						<td align="left"><a href="./landingpage.php"><img src="../css/images/home.png" alt="home" class="icon" title="Library Admin Home" /></a></td>
						<td align="right"><a href="./adminhelp.html" target="_blank"><img src="../css/images/info.png" alt="home" class="icon" title="Library Help" /></a>   <a href="./logout.php"><img src="../css/images/logout.png" alt="home" class="icon" title="Admin Logout" /></a></td>
					</tr>
					<tr>
						<td class="contentDiv" width="25%" valign="top" align="center">
							<table class="leftNavigationPane">
								<tr>
									<td><a href="./newPublicationForm.php" class="button">Create New Record</a></td>
								</tr>
								<tr>
									<td><a href="./manageData.php" class="button">Manage Data</a></td>
								</tr>
								<tr>
									<td><a href="./viewStatistics.php" class="button">Statistics</a></td>
								</tr>
								<tr>
									<td><a href="../home.html" target="_blank" class="button">View as user</a></td>
								</tr>
							</table>
						</td>
						<td class="contentDiv">
						<form>
							<a href = "./searchPublications.php">Search and Manage Publications</a><br />
							<a href = "./categoryOption.php">Manage Categories</a><br />
							<a href = "./authorOption.php">Manage Authors</a><br />
							<a href = "./publisherOption.php">Manage Publishers</a><br />
							<a href = "./tagOption.php">Manage Tags</a>
						</form>
				</td>
					</tr>
					<tr>
						<td colspan="2" class="disclaimer">Asia Minor and Pontos Hellenic Research Center Inc © 2017 All Rights Reserved.</td>
					</tr>
				</table>
			</td>
			</tr>
		</table>
	</div>
</body>
</html>
<?php
$conn->close();
}
?>