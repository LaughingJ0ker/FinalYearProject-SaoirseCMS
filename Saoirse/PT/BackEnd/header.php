<?php
require_once("../db_connect.php");
session_start();
$sid = session_id();

if (! isset($_SESSION['authenticated']))
{
	header ("Location:login.php");
}

ini_set('date.timezone', 'Europe/London');
$date = date('h:ia m/d/Y ', time());
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Administration Panel</title>
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.corner.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script src="scripts/jpicker-1.1.6.min.js" type="text/javascript"></script>


<script type="text/javascript">
function clearDefault(el) {
if (el.defaultValue==el.value) el.value = ""
}
</script>
<link rel="stylesheet" href="styles/adminStyles.css" type="text/css">
<link rel="Stylesheet" type="text/css" href="styles/jpicker-1.1.6.min.css" />

</head>
<body>
	<div id="wrapper">
		<div id="links">
			<ul id="mainLinks">
				<li><div class="linkhdr">Users</div>
					<ul>
						<li><a href="addUser.php">Add User/Admin</a></li>
						<li><a href="viewUsers.php">Update User</a></li>
						<li><a href="viewAdmin.php">Update Admin</a></li>
						<li><a href="deleteUser.php">Delete Users</a></li>
						<li><a href="deleteAdmin.php">Delete Admin</a></li>
					</ul>
				</li>
				<li><div class="linkhdr">Pages</div>
					<ul>
						<li><a href="createPage.php">Create a page</a></li>
						<li><a href="deletePage.php">Delete a page</a></li>
					</ul>
				</li>
				<li><div class="linkhdr">Layout and Colour</div>
					<ul>
						<li><a href="presetLayout.php">Preset Layout</a></li>
						<li><a href="customLayout.php">Custom Layout</a></li>
					</ul>
				</li>
	
				<li><div class="linkhdr">Site Settings</div>
					<ul>
						<li><a href="updateFooter.php">Site footer</a></li>
						<li><a href="updateEmail.php">Contact Email</a></li>
						<li><a href="updateGPS.php">GPS details</a></li>
						<li><a href="changeHdr.php">Site Header</a></li>
						<li><a href="changeBgr.php">Site Background</a></li>
						<li><a href="updateGallery.php">Gallery Size</a></li>
					</ul>
				</li>
			</ul>
		</div>