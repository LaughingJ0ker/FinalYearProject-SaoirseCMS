<?php
require_once("../db_connect.php");
session_start();
$sid = session_id();


$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);

$query1 = 'SELECT pageid FROM webpage WHERE filename ="'.$parts[count($parts) - 1].'"';
$result1 = mysql_query($query1) or die("<p>Insertion failed</p>\n");
while ($row = mysql_fetch_assoc($result1))
{
	$pageid = $row['pageid'];
}


$getCSSfilename = 'SELECT cssfilename FROM sitelayout WHERE styleid =1';
$getCSSfilenameRes = mysql_query($getCSSfilename) or die("<p>Insertion failed</p>\n");
while ($row = mysql_fetch_assoc($getCSSfilenameRes))
{
	$cssfn = $row['cssfilename'];
}

$pageTitle = "";

$query = "SELECT pagetitle FROM webpage where pageid =".$pageid;
$result = mysql_query($query) or die("SQL query failed");

while ($row = mysql_fetch_assoc($result))
{
	$pageTitle = $row['pagetitle'];
}


$query = "SELECT * FROM siteheader";
$result = mysql_query($query) or die("SQL query failed");

while ($row = mysql_fetch_assoc($result))
{
	$header = $row['header'];
	$useText = $row['useText'];
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="styles/<?php echo $cssfn; ?>" type="text/css">
		<link type='text/css' href='styles/osx.css' rel='stylesheet' media='screen' />
		<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
		<script src="scripts/jquery.min.js"></script>
		<script type='text/javascript' src='scripts/jquery.simplemodal.js'></script>
		<script type='text/javascript' src='scripts/osx.js'></script>
		<script src="galleria/galleria-1.2.9.min.js"></script>
		<title><?php echo $pageTitle; ?></title>
	</head>
<body>
<div id="wrapper">
	<div id="header">
		<?php
		if($useText == "No"){
		if(isset($_SESSION['isAdmin'])){
		$level = $_SESSION['isAdmin'];


		?>
		<script language="javascript" type="text/javascript">
			function popitup(url) {
				newwindow=window.open(url,'name','height=400,width=600');
				if (window.focus) {newwindow.focus()}
				return false;
		}
		</script>

		<div class="rollover_img">
			<a href="#" onclick="return popitup('../kcfinder/browse.php?type=files&dir=files/siteImages/hdr_img')">
			<img class="testing2" src="uploads/files/siteImages/hdr_img/hdr.jpg"  width="100%"  alt="header image">
			<span>
				To change the header image, simply click on it, in the popup window, navigate to "hdr_img" in the "siteImages" folder and upload a new file.<br />
				After you upload the new file, simply right click on it and hit "Rename". And call the file "hdr.jpg" (if you already have a header image, <br />
				you will have to either delete or rename the older image). Then close the popup window and refresh the page.
				<br>
				<b>Note: The filetype must be JPG!</b>
			</span>
			</a>
		</div>

		<?php

		}
		else{
		echo '<img src="uploads/files/siteImages/hdr_img/hdr.jpg"  width="100%" alt="header image">';
		}
		}else{
		echo "<div id='hdrtxt'>".htmlspecialchars_decode($header)."</div>";	
		}

		?>
	</div>
	<div id="nav">
		<ul class="ulnav">
		<?php
		$query = "SELECT * FROM webpage";
		$result = mysql_query($query) or die("SQL query failed");

		if(isset($_SESSION['isAdmin'])){
			echo '<li class="linav"><a href="#" class="osx">Administrator Panel</a></li>';
		}

		while ($row = mysql_fetch_assoc($result))
		{
			$pageTitle = $row['pagetitle'];
			$filename = $row['filename'];

			if($parts[count($parts) - 1] == $filename){
				echo '<li class="linav"><a class="navSelected" href='.$filename.'>'.$pageTitle.'</a>';
			}else{
				echo '<li class="linav"><a class="nav" href='.$filename.'>'.$pageTitle.'</a>';
			}
		}
		?>
		</ul>		
	</div>
	<?php
	if (isset($_SESSION['normalUser']) || isset($_SESSION['authenticated']) )
	{
		LoggedIn();
	}
	else{
		notLoggedIn();
	}
	?>