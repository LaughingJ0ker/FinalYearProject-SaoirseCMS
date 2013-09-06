<?php header("Content-type: text/css");
require("../../db_connect.php"); 
$db_link = db_connect("projecttest");


$query = "SELECT * FROM sitelayout";
$result = mysql_query($query) or die("SQL query failed");

while($row = mysql_fetch_array($result)){
	$sitebg = $row['backgroundcolour'];
	$navbg = $row['navcolour'];
	$conbg = $row['contentcolour'];
	$footbg = $row['footercolour'];
	$navhov = $row['navonhover'];
	$navtxt = $row['navtext'];
	$iscapital = $row['capitalnav'];
	$corner = $row['corner'];
	$width = $row['laywidth'];
	$useBgImg = $row['useBgImg'];
	$gh = $row['galleryheight'];
	$gw = $row['gallerywidth'];
}
?>

html, body{
	height:90%;
	min-height:90%;
	width:99%;
	<?php
	if($useBgImg == "No"){
		echo 'background-color:#'.$sitebg.';';
	}else{
		echo "background-image:url('../uploads/files/siteImages/bg_img/bgimg.jpg')";
	}
	?>
}

#wrapper{
	width:<?php echo $width; ?>;
	height:100%;
	min-height:100%;
	margin-left: auto;
	margin-right: auto;
background-color:#<?php echo $conbg; ?>;	
<?php 
if($corner == "Yes"){
echo "-webkit-border-top-left-radius: 20px;";
echo "-webkit-border-top-right-radius: 20px;";
echo "-moz-border-radius-topleft: 20px;";
echo "-moz-border-radius-topright: 20px;";
echo "border-top-left-radius: 20px;";
echo "border-top-right-radius: 20px;";
}
?>
}

#header{
width:100%;
height:25%;
overflow:hidden;
<?php 
if($corner == "Yes"){
echo "-webkit-border-top-left-radius: 20px;";
echo "-webkit-border-top-right-radius: 20px;";
echo "-moz-border-radius-topleft: 20px;";
echo "-moz-border-radius-topright: 20px;";
echo "border-top-left-radius: 20px;";
echo "border-top-right-radius: 20px;";
}
?>
}

#hdrtxt{
margin-left:10px;
}

#nav{
width:15%;
height:450px;
margin-top:0px;
background-color:#<?php echo $conbg; ?>;	
float:left;
}

#content{
width:85%;
height:450px;
overflow:auto;
background-color:#<?php echo $conbg; ?>;	
float:right;
}

#footer{
float:right;
height:10%;
width:100%;
background-color:#<?php echo $footbg; ?>;	
<?php 
if($corner == "Yes"){
echo "-webkit-border-bottom-right-radius: 20px;
-webkit-border-bottom-left-radius: 20px;
-moz-border-radius-bottomright: 20px;
-moz-border-radius-bottomleft: 20px;
border-bottom-right-radius: 20px;
border-bottom-left-radius: 20px;";
}
?>
}

#panel,#flip
{
background-color:#<?php echo $footbg; ?>;	
width:45%;
}
#panel
{
display:none;
float:right;
width:94%;

}

#flip
{
float:left;
width:6%;
}

#galleria{ 
width: <?php echo $gw; ?>px; 
height: <?php echo $gh; ?>px; 
background: #000 
}
ul.ulnav
{
list-style-type:none;
margin:0;
padding:0;
height:100%;
overflow:hidden;
}
li.linav
{
display:block;
}

a.nav:link,a.nav:visited
{
display:block;
width:100%;
font-weight:bold;
color:#<?php echo $navtxt ?>;
background-color:#<?php echo $navbg; ?>;	
text-align:center;
padding:8px;
text-decoration:none;
<?php
if($iscapital == "Yes"){
	echo 'text-transform:uppercase;';
}else{
	echo 'text-transform:none;';
}
?>
}
a.nav:hover,a.nav:active
{
background-color:#<?php echo $navhov; ?>;	
display:block;
width:100%;
}

a.navSelected:link,a.navSelected:visited
{
display:block;
width:100%;
font-weight:bold;
color:#<?php echo $navtxt ?>;
background-color:#<?php echo $navhov; ?>;
text-align:center;
padding:8px;
text-decoration:none;
<?php
if($iscapital == "Yes"){
	echo 'text-transform:uppercase;';
}else{
	echo 'text-transform:none;';
}
?>
}
a.navSelected:hover,a.navSelected:active
{
background-color:#<?php echo $navhov; ?>;
display:block;
width:100%;
}

.rollover_img a {
color: #fff;
display: block;
text-decoration: none;
}

.rollover_img a:hover {
	background:#000;
	filter:alpha(opacity=60);
}

.rollover_img a span {
	display: none;
}

.rollover_img a:hover span {
    position: absolute;
    top: 30px;
    left: 215px;
    right: 80px;
	display: block;
}