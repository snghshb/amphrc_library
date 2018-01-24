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
	<link rel="stylesheet" href="css/custom.css">
	<title>Search Home</title>
	<script>
	function validateForm() {
		var x = document.forms["searchForm"]["searchTerms"].value;
		if (x == "") {
			alert("Search query cannot be blank.");
			return false;
		}
		var pattern = new RegExp(/[~`!#$%\^&*+=\-\[\]\\';,{}|\\":<>\?]/); //unacceptable chars
		if (pattern.test(x)) {
			alert("Please input only standard alphanumerical characters in search box");
				return false;
			}
		}
	</script>
		<script> 
    $(function(){
      $("#includeFooter").load("footer2.html"); 
    });
    </script>

</head>
<body>
<div class="wrapper">
<div class="container full-width-div">
	<div class="page-header" align="center">
	<table>
			<tr>
				<td colspn="2" width="100%" align="center"><a href="http://hellenicresearchcenter.org/" target="_blank">
				<img class="img-responsive" src="./css/images/logo.png" alt="logo" title="AMPHRC Website" /></a>
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
				<a href="./help.html"><span class="glyphicon glyphicon-info-sign text-warning"></span></a>
				</button>
			</td>
			</tr>
	</table>
	</div>
	</div>
	<div class="content" align="center">
		<table border="0px" width="80%" height="400px" class="marginTable">
			<tr>
			<td><h3>Welcome to the AMPHRC Library</h3>
			<h4><small>Home to a selection of research materials hosted by the Asia Minor Pontos Hellenic Research Center</small></h4>
			</td>
			</tr>
			<tr>
			<td width="80%">
				<div class="content" align="center">
				<form action="queryoutput.php" method="post" name ="searchForm" onsubmit="return validateForm()">
					<table border="0px" width="100%">
					<tr>
						<td>
						<div class="form-group">
							<label for="searchTerms">What are you looking for?</label>
							<input type = "text" class="form-control" name= "searchTerms" placeholder="Your search keywords..">
						</div>
						</td>
					</tr>
					<tr>
						<td align="center">
						<button type="submit" class="btn btn-default">
						SEARCH <span class="glyphicon glyphicon-search"></span>
						</button>
						</td>
					</tr>
					</table>
				</form>
				</div>
			</td>
			</tr>
			<tr>
			<td>
				<blockquote class="text-justify">
				<p>The Asia Minor and Pontos Hellenic Research Center (AMPHRC) is a historical society and a 501 (c) (3) non-profit organization founded in January 2011. Our goal as a research center—unique in its kind—is to document and disseminate information about the Greek communities of the later Ottoman empire, and study the expulsion of expulsion of the Greeks from  their ancestral homelands in Asia Minor (or Anatolia), Eastern Thrace, and Pontos.</p>
				<footer><a href="http://hellenicresearchcenter.org/about/" target="_blank">The Asia Minor and Pontos Hellenic Research Center</a></footer>
				</blockquote></td>
			</tr>
			<tr>
			<td><p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p></td>
			</tr>
			<tr>
			<td><div id="includeFooter"></div></td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>