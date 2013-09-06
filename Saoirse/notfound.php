<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Sorry, we couldn't find that page</title>	
</head>
<body>
<?php
	$currentFile = $_SERVER["REQUEST_URI"];
	$parts = Explode('/', $currentFile);
?>

		<center>
		<h1>We apologise</h1><br>
		<h2>The page you requested "<?php echo $parts[count($parts) - 1]; ?>" was not found on the server. <br>If you would like to go back one page click <a href="javascript: history.go(-1)">back</a><br>
		<br>If you would like to go to the home page, click <a href="../../pt/Frontend/index.php">here</a></h2>
		</center>
	
</body>
</html>