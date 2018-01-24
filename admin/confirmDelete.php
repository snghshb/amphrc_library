<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
?>
<?php
echo "File was deleted successfully";

echo "<br /><br /><a href=\"./viewExisting.php\">Click here to go back to the earlier page</a>";

header('Location: ./searchResults.php');

?>
<?php
$conn->close();
}
?>