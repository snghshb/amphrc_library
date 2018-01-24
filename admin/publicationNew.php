<?php
	include('config.php');
	//function renderForm($publication_id, $category_id, $title, $isbn, $publish_year, $start_year, $end_year, $volume, $description, $availability_id, $error){
	
	function renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publisher_city, $publisher_state, $publisher_country, $publish_year, $start_year, $end_year, $volume, $description, $url, $file_location, $tags, $error){

		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

		<html>

		<head>

		<title>New Record</title>

		</head>

		<body>

		<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

		?>
		<form action="" method="post">

		<div>

		

		<strong>Category Name : *</strong> <input type="text" name="category_name" list="category_list" value = "<?php echo $category_name;?>"/><br/>	
		<strong>Title : *</strong> <input type="text" name="title" value="<?php echo $title; ?>" /><br/>
		<strong>Author First Name : </strong> <input type="text" name="author_first_name" value="<?php echo $author_first_name; ?>" /><br/>
		<strong>Author Last Name : </strong> <input type="text" name="author_last_name" value="<?php echo $author_last_name; ?>" /><br/>
		<strong>isbn : </strong> <input type="text" name="isbn" value="<?php echo $isbn; ?>" /><br/>
		<strong>Publisher Name : </strong> <input type="text" name="publisher_name" list="publisher_name_list" value = "<?php echo $publisher_name;?>"/><br/>
			
		<strong>Publisher City : </strong> <input type="text" name="publisher_city" list="publisher_city_list"/><br/>
			
		<strong>Publisher State/Province : </strong> <input type="text" name="publisher_state" list="publisher_state_list"/><br/>
			
		<strong>Publisher Country : </strong> <input type="text" name="publisher_country" list="publisher_country_list"/><br/>
			
		<strong>publish year : </strong> <input type="text" name="publish_year" value="<?php echo $publish_year; ?>" /><br/>
		<strong>start year : </strong> <input type="text" name="start_year" value="<?php echo $start_year; ?>" /><br/>
		<strong>end year : </strong> <input type="text" name="end_year" value="<?php echo $end_year; ?>" /><br/>
		<strong>volume : </strong> <input type="text" name="volume" value="<?php echo $volume; ?>" /><br/>
		<strong>Description : </strong> <input type="text" name="description" value="<?php echo $description; ?>" /><br/>
		<strong>Partner Database URL : </strong> <input type="text" name="url" id = "url" value="<?php echo $url; ?>" />
		<strong></strong> <input type="checkbox" name="checkbox" id="checkbox" onClick="disable_enable()" value="1">Available in library<br/>
		<strong>File Upload : </strong> <input type="file" name="file_location" id="file_location"/><br /><br/>
		<strong>Tags (one per line) : *</strong> <textarea type="text" name="tags" id="tags" cols="40" rows="7"></textarea>
		<p>* required</p>

		<input type="submit" name="submit" value="Submit">

		</div>

		</form>

		</body>
			<script type="text/javascript">
				function disable_enable()
				{
					if(document.getElementById("checkbox").checked != 1)
					{
						document.getElementById("url").removeAttribute("disabled");
						
					}
					else
					{
						document.getElementById("url").valueAttribute("disabled","disabled");
						
					}
				}
			</script>
			
		</html>

		<?php

		}
		
	
	if (isset($_POST['submit'])){
		$title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title']));
		$result = mysqli_query($conn, "SELECT title from publications where title='$title'");
		
		if(mysqli_num_rows($result)==0){	

			$publisher_id = '';
			$category_id = '';
			$author_id = '';
			$keyword_id = '';
			$publication_id = '';
			
			$category_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category_name']));
			$author_first_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['author_first_name']));
			$author_last_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['author_last_name']));
			$isbn = mysqli_real_escape_string($conn, htmlspecialchars($_POST['isbn']));
			$publisher_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publisher_name']));
			$publisher_city = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publisher_city']));
			$publisher_state = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publisher_state']));
			$publisher_country = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publisher_country']));
			$publish_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['publish_year']));
			$start_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['start_year']));
			$end_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['end_year']));
			$volume = mysqli_real_escape_string($conn, htmlspecialchars($_POST['volume']));
			$description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['description']));
			if (isset($_POST['checkbox'])){
				$url = mysqli_real_escape_string($conn, htmlspecialchars('static library url'));
			}
			else{
				$url = mysqli_real_escape_string($conn, htmlspecialchars($_POST['url']));

			}
			$file_location = mysqli_real_escape_string($conn, htmlspecialchars($_POST['file_location']));
			
						
			
			if (!empty($file_location) && !isset($_POST['checkbox'])){
				$url = "";
				$availability_id = "0";
			}
			elseif (isset($_POST['checkbox']) && empty($file_location)){
				$availability_id = "1";
			}
			elseif (isset($_POST['checkbox']) && !empty($file_location)){
				$availability_id = "2";
			}
			elseif (empty($file_location) && !isset($_POST['checkbox']) && !empty($url)){
				$availability_id = "3";
			}
			else{
				$error = "No info given for accessing the file (no file uploaded, url given, or indication of availability in library";
				renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publisher_city, $publisher_state, $publisher_country, $publish_year, $start_year, $end_year, $volume, $description, $url, $file_location, $tags, $error);
			}
			$taginput = isset($_POST['tags'])?$_POST['tags']:"";
			//$taginput = $_POST['tags'];
			if(strlen($taginput==0)){
				$echo = "No tags given";

			}
			$tags = explode("\n", str_replace("\r", "", $taginput));
			foreach ($tags as $value){
				//echo $value."\n";
			}
			
		
		
			if ( $category_name == '' || $title == '' ||  $tags == '' ){
				// generate error message
				$error = 'ERROR: Please fill in all required fields!';
				// if either field is blank, display the form again
				renderForm($category_name, $title, $author_first_name, $author_last_name, $isbn, $publisher_name, $publisher_city, $publisher_state, $publisher_country, $publish_year, $start_year, $end_year, $volume, $description, $url, $file_location, $tags, $error);
			}else{
				//echo "You made it this far";
				
				$result = mysqli_query($conn, "SELECT * from category where upper(category_name)=upper('$category_name')");			
				
				if(mysqli_num_rows($result)==0){
					mysqli_query($conn, "insert into category (category_name) values ('$category_name')");
					$result = mysqli_query($conn, "select * from category where category_name = upper('$category_name')");
					while($row = mysqli_fetch_array($result)) {
					$category_id = $row['category_id'];
					}
				}
				else{
					while($row = mysqli_fetch_array($result)) {
					$category_id = $row['category_id'];
				}
				}
				
				if(!empty($author_last_name) || !empty($author_first_name)){
					$result = mysqli_query($conn, "SELECT * from author where upper(author_first_name)=upper('$author_first_name') and upper(author_last_name)=upper('$author_last_name')");
					if(mysqli_num_rows($result)==0){
						mysqli_query($conn, "insert into author (author_first_name, author_last_name ) values ('$author_first_name','$author_last_name')");
						$result = mysqli_query($conn, "SELECT * from author where upper(author_first_name)=upper('$author_first_name') and upper(author_last_name)=upper('$author_last_name')");
						while($row = mysqli_fetch_array($result)) {
						$author_id = $row['author_id'];
						}
					}
					else{
						while($row = mysqli_fetch_array($result)) {
						$author_id = $row['author_id'];
						}
					}
				}
				if(!empty($publisher_name)){
					//echo "Publisher Name: ".$publisher_name;
					$result = mysqli_query($conn, "SELECT * FROM `publisher` WHERE upper(publisher_name) = upper('$publisher_name') and upper(city) = upper('$publisher_city') and upper(`state/province`) = upper('$publisher_state') and upper(country) = upper('$publisher_country')");
					if(mysqli_num_rows($result)==0){
						mysqli_query($conn, "insert into publisher (publisher_name, city , `state/province`, country)values ('$publisher_name','$publisher_city','$publisher_state','$publisher_country')");
					//	echo "publisher info passed";
						$result = mysqli_query($conn, "SELECT * FROM `publisher` WHERE upper(publisher_name) = upper('$publisher_name') and upper(city) = upper('$publisher_city') and upper(`state/province`) = upper('$publisher_state') and upper(country) = upper('$publisher_country')");
						while($row = mysqli_fetch_array($result)) {
						$publisher_id = $row['publisher_id'];
					//echo "publisher id after insert into : ".$publisher_id;
					}
					}
					else{
						while($row = mysqli_fetch_array($result)) {
						$publisher_id = $row['publisher_id'];
						}
					}
					
				}	
				
				foreach ($tags as $value){
					//echo $value." ";
					$result = mysqli_query($conn, "SELECT * from keyword where upper(keyword)=upper('$value')");
					if(mysqli_num_rows($result)==0){
						mysqli_query($conn, "insert into keyword (keyword) values ('$value')");
						
						}
				}
				
				
					
				//mysqli_query($conn, "insert into publications value publication_id = '$publication_id', category_id='$category_id', title='$title', isbn='$isbn', publish_year='$publish_year', start_year='$start_year', end_year='$end_year', volume='$volume', description='$description', availability_id='$availability_id'")
				mysqli_query($conn, "insert into publications (category_id, title, isbn, publish_year, start_year, end_year, volume, description, availability_id) values ('$category_id', '$title', '$isbn', '$publish_year', '$start_year', '$end_year', '$volume', '$description', '$availability_id')");;
				$result = mysqli_query($conn, "SELECT * FROM publications WHERE category_id='$category_id' and title='$title' and isbn='$isbn' and publish_year='$publish_year' and start_year='$start_year' and end_year='$end_year' and volume='$volume' and description='$description' and availability_id='$availability_id'");
				
				while($row = mysqli_fetch_array($result)) {
					$publication_id = $row['publication_id'];
				}
				
				
				if(isset($publisher_name)){
				mysqli_query($conn, "insert into publication_publisher (publication_id, publisher_id) values ('$publication_id', '$publisher_id')");;
				}
				echo $publication_id. " ". $publisher_id. " "."insert into publication_publisher (publication_id, publisher_id) values ('$publication_id', '$publisher_id')";

				if(isset($author_last_name) || isset($author_first_name)){

				mysqli_query($conn, "insert into publication_author (publication_id, author_id) values ('$publication_id', '$author_id')");;
				}
				
				foreach ($tags as $value){
				$result = mysqli_query($conn, "SELECT * from keyword where upper(keyword)=upper('$value')");
				//echo "keyword id: ";
					while($row = mysqli_fetch_array($result)) {
						$keyword_id = $row['keyword_id'];
						//echo $keyword_id. " ";
						
						mysqli_query($conn, "insert into publication_keyword (publication_id, keyword_id) values ('$publication_id', '$keyword_id')");
					}
				}
				
				
				if(!empty($url)){
					mysqli_query($conn, "insert into url (publication_id, url) values ('$publication_id', '$url')");

				}
				if(!empty($file_location)){
					mysqli_query($conn, "insert into file_location (publication_id, file_location) values ('$publication_id', '$file_location')");

				}
				//echo "Category ID: ".$category_id;
				//echo "publiiication id: ".$publication_id;
				//echo "author id: ".$author_id;
				//echo "publisher id: ".$publisher_id;
				//header("Location: view.php");
			}
		} else {
				echo "A publication with this title already exists. Modify or delete that one.";
		}
	} else{
		renderForm('','','','','','','','','','','','','','','','','', '');
	
		
	
	
	
	

	
	
	}
?>