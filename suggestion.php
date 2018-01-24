<?php
include('config.php');
$result = mysqli_query($conn,"SELECT keyword FROM amphrc_library.keyword");
while($row = mysqli_fetch_array($result)) {
	echo "\"".$row['keyword']."\", ";
}
?>