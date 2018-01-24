<html>
<head>
	<title>Administrator - View Existing Library</title>
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
									<td><a href="./fileuploadform.php" class="button">Upload file</a></td>
								</tr>
								<tr>
									<td><a href="./editExisting.php" class="button">Edit existing files</td>
								</tr>
								<tr>
									<td><a href="./viewExisting.php" class="button">View existing library</a></td>
								</tr>
								<tr>
									<td><a href="./viewStatistics.php" class="button">Statistics</a></td>
								</tr>
								<tr>
									<td><a href="../home.php" target="_blank" class="button">View as user</a></td>
								</tr>
							</table>
						</td>
						<td class="contentDiv">
<?php
// connect to the database
include('config.php');

// get results from database
$result = mysqli_query($conn,"SELECT * FROM publications");

// display data in table
echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";

echo "<table border='1px' width=\"100%\">";

echo '<tr>
	<th>ID</th>
	<th width="80%">File Information</th>
	<th colspan="3">Actions</th>
	</tr>';

// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array($result)) {
// echo out the contents of each row into a table
	echo '<tr>';
	echo '<td rowspan="3">' . $row['publication_id'] . '</td>';
	echo '<td width="300px">' . $row['title'] . '</td>';
	echo '<td colspan="3">';
	$availability_id = $row['availability_id'];
	if ($availability_id == 0)
		echo "Online";
	else if ($availability_id == 1)
		echo "On-premise";
	else if ($availability_id == 2)
		echo "Online/on-premise";
	else echo "Partner";
	echo '</td>';
	echo '</tr><tr>';
	echo '<td width="300px">' . $row['description'] . '</td>';
	echo '<td rowspan="2"><a href="viewAllDetails.php?publication_id=' . $row['publication_id'] . '">
	<img src="../css/images/view.png" alt="edit" class="icon" title="FileView" /></a></td>';
	echo '<td rowspan="2"><a href="editExisting.php?publication_id=' . $row['publication_id'] . '">
	<img src="../css/images/edit.png" alt="edit" class="icon" title="FileEdit" /></a></td>';
	echo '<td rowspan="2"><a href="delete.php?publication_id=' . $row['publication_id'] . '">
	<img src="../css/images/delete.png" alt="delete" class="icon" title="FileDelete" /></a></td>';
	echo '</tr>';
	echo '<td>';
	$category_id = $row['category_id'];
	$result1 = mysqli_query($conn,"SELECT * FROM category WHERE category_id=$category_id");
	while ($row1 = mysqli_fetch_array($result1))
			echo $row1['category_name'];
	echo '</td>';
	
	
}

// close table>
echo "</table>";
?>
<p><a href="fileuploadform.php">Add a new record</a></p>
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