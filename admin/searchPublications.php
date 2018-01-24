<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./home.php');
else {
session_start();
include ('config.php');
if(isset($_POST['submit'])){
	//$searchsql = "Select p.publication_id, c.category_name, p.title, p.isbn, p.publish_year, p.start_year, p.end_year, p.volume, p.description, p.availability_id from publications p, category c, publisher u where  c.category_name = (select t.category_name from category t where t.category_id = p.category_id)";
	//$searchsql = "Select p.publication_id, c.category_name, p.title, p.isbn, (select u.publisher_name from publisher u where u.publisher_id = (select DISTINCT(v.publisher_id) from publication_publisher v where p.publication_id = v.publication_id)) as publisher_name, p.publish_year, p.start_year, p.end_year, p.volume, p.description, p.availability_id from publications p, category c where c.category_name = (select t.category_name from category t where t.category_id = p.category_id) ";
	$searchsql = "Select p.publication_id, c.category_name, p.title, (select u.author_first_name from author u where u.author_id = (select DISTINCT(v.author_id) from publication_author v where p.publication_id = v.publication_id)) as author_first_name, (select u.author_last_name from author u where u.author_id = (select DISTINCT(v.author_id) from publication_author v where p.publication_id = v.publication_id)) as author_last_name, p.isbn, (select u.publisher_name from publisher u where u.publisher_id = (select DISTINCT(v.publisher_id) from publication_publisher v where p.publication_id = v.publication_id)) as publisher_name, (select u.city from publisher u where u.publisher_id = (select DISTINCT(v.publisher_id) from publication_publisher v where p.publication_id = v.publication_id)) as publisher_city, (select u.`state` from publisher u where u.publisher_id = (select DISTINCT(v.publisher_id) from publication_publisher v where p.publication_id = v.publication_id)) as 'publisher_state', (select u.country from publisher u where u.publisher_id = (select DISTINCT(v.publisher_id) from publication_publisher v where p.publication_id = v.publication_id)) as publisher_country, p.publish_year, p.start_year, p.end_year, p.volume, p.description, p.availability_id from publications p, category c where c.category_name = (select t.category_name from category t where t.category_id = p.category_id) ";
	$category_id = '';
	$title ='';
	$isbn = '';
	$author_first_name ='';
	$author_last_name ='';
	$publisher_name = '';
	$publisher_city = '';
	$publisher_state = '';
	$publisher_country = '';
	$publish_year = '';
	$start_year = '';
	$end_year = '';
	
	if(!empty($_POST['category_name'])){
		$category_id = "and p.category_id = (select category_id from category where category_name = '".$_POST['category_name']."') ";
	}
	if(!empty($_POST['title'])){
		$title = "and p.title = '".$_POST['title']."' ";
	}
	if(!empty($_POST['author_first_name'])){
		$author_first_name = "and publication_id in (select publication_id from publication_author where author_id = (select author_id from author where author_first_name = '".$_POST['author_first_name']."')) ";
	}
	if(!empty($_POST['author_last_name'])){
		$author_last_name = "and publication_id in (select publication_id from publication_author where author_id = (select author_id from author where author_last_name = '".$_POST['author_last_name']."')) ";
	}
	if(!empty($_POST['publisher_name'])){
		$publisher_name = "and publication_id in (select publication_id from publication_publisher where publisher_id in (select publisher_id from publisher where publisher_name = '".$_POST['publisher_name']."')) ";
	}
	if(!empty($_POST['publisher_city'])){
		$publisher_city = "and publication_id in (select publication_id from publication_publisher where publisher_id in (select publisher_id from publisher where city = '".$_POST['publisher_city']."')) ";
	}
	if(!empty($_POST['publisher_state'])){
		$publisher_state = "and publication_id in (select publication_id from publication_publisher where publisher_id in (select publisher_id from publisher where `state` = '".$_POST['publisher_state']."')) ";
	}
	if(!empty($_POST['publisher_country'])){
		$publisher_country = "and publication_id in (select publication_id from publication_publisher where publisher_id in (select publisher_id from publisher where country = '".$_POST['publisher_country']."')) ";
	}
	if(!empty($_POST['publish_year'])){
		$publish_year = "and p.publish_year = '".$_POST['publish_year']."' ";
	}
	if(!empty($_POST['start_year'])){
		$start_year = "and p.start_year = '".$_POST['start_year']."' ";
	}
	if(!empty($_POST['end_year'])){
		$end_year = "and p.end_year = '".$_POST['end_year']."' ";
	}
	if(!empty($_POST['isbn'])){
		$isbn = "and p.isbn = '".$_POST['isbn']."' ";
	}
	if(!empty($_POST['availability_id'])){
		$availability_id = "and p.availability_id = '".$_POST['availability_id']."' ";
	}
	$orderBy = "order by p.title asc";
	$salt = 'sqlsalt';
	$query = $searchsql.$category_id.$author_first_name.$author_last_name.$publisher_name.$publisher_city.$publisher_state.$publisher_country.$publish_year.$start_year.$end_year.$isbn.$orderBy;
	//$url  = '?'.http_build_query(array('query' => $query, 'hash' => md5($query.$salt)));
	$_SESSION['query'] = $query;
	//header('Location: searchResults.php'.$url);
	header('Location: ./searchResults.php');
}
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
	<title>Administrator - Search Publications</title>
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
</head>
<body>
<div class="wrapper">
<div id="includeHeader"></div>
<div id="includeNavbar"></div>
<div class="content" align="center">
	<table border="1px" width="80%" height="400px" class="marginTable" style="border-style: groove;">
	<tr>
	<td valign="top">
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="publication_id" value="<?php echo $publication_id; ?>"/>
								<table class="table table-striped">							
								<tbody><tr><td colspan = 2>Choose search criteria</td></tr>
								<tr>
								
								<td>Category </td>
								<td><select name = 'category_name'>
<?php
										echo "<option value = ''></option>";
										$sql = "Select category_name from category order by category_name asc";
										$result = mysqli_query($conn, $sql);
										while ($row = mysqli_fetch_array($result)){
										echo "<option value='" . $row['category_name'] . "'>".$row['category_name']."</option>";
										}
?>
								</select></td>
								</tr>
								<tr>
								<td>Title</td> 
								<td><input type="text" name="title"/></td>
								</tr>
								<tr>
								<td>Author First Name</td>
								<td><input type="text" name="author_first_name"/>
								</tr>
								<tr>
								<td>Author Last Name</td>
								<td><input type="text" name="author_last_name"/></td>
								</tr>
								<tr>
								<td>Enter ISBN</td> 
								<td><input type="text" name="isbn"/></td>
								</tr>
								<tr>
								<td>Publisher Name</td> 
								<td><select name = 'publisher_name'>
<?php
										echo "<option value = ''></option>";
										$sql = "Select publisher_name from publisher order by publisher_name asc";
										$result = mysqli_query($conn, $sql);
										while ($row = mysqli_fetch_array($result)){
										echo "<option value='" . $row['publisher_name'] . "'>".$row['publisher_name']."</option>";
										}
?>
								</select></td>
								</tr>
								<tr>
								<td>Publisher City</td> 
								<td><input type="text" name="publisher_city" list="publisher_city_list"/></td>
								</tr>
								<tr>
								<td>Publisher State</td> 
								<td><input type="text" name="publisher_state" list="publisher_state_list" /></td>
								</tr>
								<tr>
								<td>Publisher Country</td> 
								<td><input type="text" name="publisher_country" list="publisher_country_list"/></td>
								</tr>
								<tr>
								<td>Publish Year</td> 
								<td><input type="text" name="publish_year"/></td>
								</tr>
								<tr>
								<td>Start Year</td> 
								<td><input type="text" name="start_year"/></td>
								</tr>
								<tr>
								<td>End Year</td> 
								<td><input type="text" name="end_year"/></td>
								</tr>
								<tr>
								<td>Availability ID</td>
								<td><select name = "availability_id">
								<option value=""></option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option
								</select>
								</td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Search" name="submit"></td>
								</tr>
								</tbody>
								</table>
						</form>
				</td>
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