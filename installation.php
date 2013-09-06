<!DOCTYPE HTML>
<html>
<head>
<title>
Installation of SaoirseCMS
</title>
<style>
html, body{
background-color:#D9EBF3;
padding:1%;
}

#installForm{
	height:470px;
	width:420px;
	background-color:#9FCCE1;
	margin:auto;
	
	padding-left:20px;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
}
.classname {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0e7fb3), color-stop(1, #0e7fb3) );
	background:-moz-linear-gradient( center top, #0e7fb3 5%, #0e7fb3 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0e7fb3', endColorstr='#0e7fb3');
	background-color:#0e7fb3;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#f0f0f0;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
	padding:4px 12px;
	text-decoration:none;
}.classname:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0e7fb3), color-stop(1, #0e7fb3) );
	background:-moz-linear-gradient( center top, #0e7fb3 5%, #0e7fb3 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0e7fb3', endColorstr='#0e7fb3');
	background-color:#0e7fb3;
}.classname:active {
	position:relative;
	top:1px;
}
</style>
</head>
<body>
<div id="installForm">
	<h2>Thank you for installing SaoirseCMS!</h2>

	Please enter the details below, and hit "Finish Installation" to complete this installation!
	<br />
	Tip: Hover over the "?" to see what each part is!
	<form form name="details" method="post">
		<table>
		<tr>
		<td colspan="2"><hr width="380"/></td><td></td>
		</tr>
		<tr>
		<td><strong>Database details</strong></td>
		</tr>			
			<tr>
				<td>MySQL Server Address: </td><td><input type="text" name="serveradd" value="<?php if(isset($_REQUEST['serveradd'])) echo $_REQUEST['serveradd'];?>">   <abbr title="Address of your MySQL Server to install the database">?</abbr></td>
			</tr>

			<tr>
				<td>MySQL Username: </td><td><input type="text" name="serverusername" value="<?php if(isset($_REQUEST['serverusername'])) echo $_REQUEST['serverusername'];?>">   <abbr title="Username of MySQL Server to install the database">?</abbr></td>
			</tr>

			<tr>
				<td>MySQL Password: </td><td><input type="password" name="serverpassword">   <abbr title="Password of your MySQL Server to install the database">?</abbr></td>
			</tr>
		<tr>
		<td colspan="2"><hr width="380"/></td><td></td>
		</tr>
		<tr>
		<td><strong>Information</strong></td>
		</tr>
		<tr>
			<tr>
				<td>Your Email: </td><td><input type="text" name="email" value="<?php if(isset($_REQUEST['email'])) echo $_REQUEST['email'];?>">   <abbr title="This is the email that will be used if you create a 'contact' page.">?</abbr></td>
			</tr>

			<tr>
				<td>Website Footer: </td><td><input type="text" name="footer" value="<?php if(isset($_REQUEST['footer'])) echo $_REQUEST['footer'];?>">   <abbr title="This is the text that will appear at the bottom of every page of your site">?</abbr></td>
			</tr>
			<tr>
				<td>Administrator Username: </td><td><input type="text" name="adminuser" value="<?php if(isset($_REQUEST['adminuser'])) echo $_REQUEST['adminuser'];?>">   <abbr title="These are the account details which you'll use to start building your website!">?</abbr></td>
			</tr>

			<tr>
				<td>Administrator Password: </td><td><input type="password" name="adminpass1"></td>
			</tr>
			
			<tr>
				<td>Confirm Password:</td><td><input type="password" name="adminpass2"></td>
			</tr>
			<tr>
				<td colspan="2"><hr width="380"/></td><td></td>
			</tr>				
			</table>
		<input type="submit" name="submitDetails" class="classname" value="Finish Installation"><input type="reset" class="classname" value="Reset">

	</form>
</div>
</body>
</html>

<?php
if(isset($_REQUEST['submitDetails'])){

$mysqlserver = trim($_REQUEST['serveradd']);
$mysqlusername = trim($_REQUEST['serverusername']);
$mysqlpass = trim($_REQUEST['serverpassword']);
$email = trim($_REQUEST['email']);
$footer = trim($_REQUEST['footer']);
$adminusername = trim($_REQUEST['adminuser']);
$adminpass1 = trim($_REQUEST['adminpass1']);
$adminpass2 = trim($_REQUEST['adminpass2']);

//echo $mysqlserver,$mysqlusername,$mysqlpass,$email,$footer,$adminusername,$adminpass1,$adminpass2;

$installok = true;
$error = "Error.";

if(!notBlank($mysqlserver,$mysqlusername,$email,$footer,$adminusername,$adminpass1,$adminpass2))
{
	$installok = false;
	$error .= " No field (apart from MySQL Password) can be left blank";
}

//check valid email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$installok = false;
	$error .= " Email address is not valid";
}

//Check valid admin passwords
if($adminpass1 != $adminpass2){
$installok = false;
$error .= " Both admin passwords must match";
}

if($installok)
{

$adminpassword = addslashes($adminpass1);

$adminpassword .= "*salt_*";
createDatabase($mysqlserver,$mysqlusername,$mysqlpass, $email,$footer,$adminusername,$adminpassword);
}
else{
echo $error;
}
}

function notBlank($mysqlserver,$mysqlusername,$email,$footer,$adminusername,$adminpass1,$adminpass2)
{
	if(empty($mysqlserver) || empty($mysqlusername) || empty($email) || empty($footer) || empty($adminusername) || empty($adminpass1) || empty($adminpass2))
	{
		return false;
	}
return true;
}

function createDatabase($serveradd, $serveruser, $serverpass, $email, $footer, $adminuser, $adminpass){
$con = mysql_connect($serveradd,$serveruser,$serverpass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

if (mysql_query("CREATE DATABASE saoirse",$con))
  {
  echo "Database created";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }  

mysql_select_db("saoirse", $con);

$sql = "CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
);";

$sql1 = "CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql2 = "CREATE TABLE IF NOT EXISTS `sitefooter` (
  `footer` varchar(75) NOT NULL,
  PRIMARY KEY (`footer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$sql3 = "CREATE TABLE IF NOT EXISTS `sitelayout` (
  `styleid` int(3) NOT NULL AUTO_INCREMENT,
  `cssfilename` varchar(50) NOT NULL,
  `layout` varchar(50) DEFAULT NULL,
  `colour` varchar(50) DEFAULT NULL,
  `backgroundcolour` varchar(10) DEFAULT NULL,
  `navcolour` varchar(10) DEFAULT NULL,
  `contentcolour` varchar(10) DEFAULT NULL,
  `footercolour` varchar(10) DEFAULT NULL,
  `usingcustom` varchar(3) DEFAULT NULL,
  `navonhover` varchar(10) DEFAULT NULL,
  `navtext` varchar(10) DEFAULT NULL,
  `capitalnav` varchar(3) DEFAULT NULL,
  `corner` varchar(10) DEFAULT NULL,
  `laywidth` varchar(4) DEFAULT NULL,
  `useBgImg` varchar(5) DEFAULT NULL,
  `galleryheight` int(4) DEFAULT NULL,
  `gallerywidth` int(4) DEFAULT NULL,
  PRIMARY KEY (`styleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";

$sql4 = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `privlevel` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;";

$sql5 = "CREATE TABLE IF NOT EXISTS `webpage` (
  `pageid` int(3) NOT NULL AUTO_INCREMENT,
  `pagetitle` varchar(25) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `unpubcontent` varchar(5000) DEFAULT NULL,
  `lastmodified` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;
";

$sql6 = "INSERT INTO `email` (`id`, `email`) VALUES
(1, '$email');";

$sql7 = "INSERT INTO `sitefooter` (`footer`) VALUES
('$footer');";

$sql8 = "INSERT INTO `sitelayout` (`styleid`, `cssfilename`, `layout`, `colour`, `backgroundcolour`, `navcolour`, `contentcolour`, `footercolour`, `usingcustom`, `navonhover`, `navtext`, `capitalnav`, `corner`, `laywidth`, `useBgImg`, `galleryheight`, `gallerywidth`) VALUES
(1, 'LO1/blue.css', 'LO1', 'blue', '5fbf00', 'ffaa56', 'ffd4aa', 'ffaa56', 'No', 'ff5656', 'ffffff', 'No', 'Yes', '80%', 'No', 480, 640);";

$sql9 = "INSERT INTO `webpage` (`pageid`, `pagetitle`, `filename`, `content`, `unpubcontent`, `lastmodified`) VALUES
(85, 'Home', 'index.php', '', '', '');";

$sql10 = "INSERT INTO `admin` (`username`, `password`) VALUES
('$adminuser', SHA1('$adminpass'));";

$sql11 = "CREATE TABLE IF NOT EXISTS `locationinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gpslat` varchar(20) NOT NULL,
  `gpslon` varchar(20) NOT NULL,
  `gpsfull` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";

$sql12 = "CREATE TABLE IF NOT EXISTS `siteheader` (
  `id` int(10) NOT NULL,
  `header` varchar(250) NOT NULL,
  `useText` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$sql13 = "INSERT INTO `siteheader` (`id`, `header`, `useText`) VALUES
(1, 'Please update your header in the admin panel', 'No');";

// Execute query
if(mysql_query($sql,$con))
{
	echo ":) x";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql1,$con))
{
	echo ":) 1";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql2,$con))
{
	echo ":) 2";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql3,$con))
{
	echo ":) 3";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql4,$con))
{
	echo ":) 4";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql5,$con))
{
	echo ":) 5";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql6,$con))
{
	echo ":) 6";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql7,$con))
{
	echo ":) 7";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql8,$con))
{
	echo ":) 8";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql9,$con))
{
	echo ":) 9";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql10,$con))
{
	echo ":) 10";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql11,$con))
{
	echo ":) 11";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql12,$con))
{
	echo ":) 12";
}else
{
	echo ":(";
}

// Execute query
if(mysql_query($sql13,$con))
{
	echo ":) 13";
}else
{
	echo ":(";
}

mysql_close($con);
echo "<a href='../pt/Frontend/index.php'>Installation Successful! Click here to go to your new website! Enjoy!</a>";

}
?> 