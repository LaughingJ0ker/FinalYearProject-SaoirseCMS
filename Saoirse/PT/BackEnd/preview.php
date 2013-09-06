<?php
session_start();
$sid = session_id();

if (! isset($_SESSION['authenticated']))
{
	header ("Location:login.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<?php

	$siteBG = $_REQUEST['sitebg'];
	$navBG = $_REQUEST['navbg'];
	$conBG = $_REQUEST['conbg'];
	$footBG = $_REQUEST['footbg'];	
	$navhov = $_REQUEST['navhov'];
	$navtxt = $_REQUEST['navtxt'];
	$layout = $_REQUEST['layout'];
	$width = $_REQUEST['width'];
	$capital = $_REQUEST['capital'];
	$corner = $_REQUEST['corner'];
	
echo '<style>';	
if($layout == "styles1" || $layout == "styles2"){
?>
html, body{
	height:90%;
	min-height:90%;
	width:99%;
	background-color:#<?php echo $siteBG; ?>;	

}

#wrapper{
	width:<?php echo $width; ?>;
	height:100%;
	min-height:100%;
	margin-left: auto;
	margin-right: auto;
	background-color:#<?php echo $conBG; ?>;	
}

#header{
width:100%;
height:25%;
overflow:hidden;
background-color:white;
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

#nav{
width:100%;
height:5%;
margin-top:0px;
background-color:#<?php echo $navBG; ?>;	

}

#content{
	width:100%;
	height:80%;
	overflow:auto;
	margin-right:15px;
	background-color:#<?php echo $conBG; ?>;	
}

#footer{
	width:100%;
	height:10%;
	margin-left: auto;
	margin-right: auto;
	background-color:#<?php echo $footBG; ?>;
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
display:inline;
}

a.nav:link,a.nav:visited
{
display:inline;
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
?>}
a.nav:hover,a.nav:active
{
background-color:#<?php echo $navhov; ?>;	
display:inline;
width:100%;
}

a.navSelected:link,a.navSelected:visited
{
display:inline;
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
?>}
a.navSelected:hover,a.navSelected:active
{
background-color:#<?php echo $navhov; ?>;
display:inline;
width:100%;
}
<?php
}else if($layout == "styles3"){
?>
html, body{
	height:90%;
	min-height:90%;
	width:99%;
	background-color:#<?php echo $siteBG; ?>;	

}

#wrapper{
	width:<?php echo $width; ?>;
	height:100%;
	min-height:100%;
	margin-left: auto;
	margin-right: auto;
background-color:#<?php echo $conBG; ?>;	

}

#header{
width:100%;
height:25%;
overflow:hidden;
background-color:white;
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

#nav{
width:20%;
height:420px;
margin-top:0px;
background-color:#<?php echo $conBG; ?>;	
float:left;
}

#content{
width:80%;
height:420px;
overflow:auto;
background-color:#<?php echo $conBG; ?>;	
float:right;

}

#footer{
float:right;
	width:100%;
	height:10%;
	background-color:#<?php echo $footBG; ?>;
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
background-color:#<?php echo $navBG; ?>;	
text-align:center;
padding:8px;
text-decoration:none;
<?php
if($iscapital == "Yes"){
	echo 'text-transform:uppercase;';
}else{
	echo 'text-transform:none;';
}
?>}
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
?>}
a.navSelected:hover,a.navSelected:active
{
background-color:#<?php echo $navhov; ?>;
display:block;
width:100%;
} 
<?php
}else if($layout == "styles4"){
?>
html, body{
	height:90%;
	min-height:90%;
	width:99%;
	background-color:#<?php echo $siteBG; ?>;	

}

#wrapper{
	width:<?php echo $width; ?>;
	height:100%;
	min-height:100%;
	margin-left: auto;
	margin-right: auto;
background-color:#<?php echo $conBG; ?>;	

}

#header{
width:100%;
height:25%;
overflow:hidden;
background-color:white;
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

#nav{
width:20%;
height:420px;
margin-top:0px;
background-color:#<?php echo $conBG; ?>;	
float:left;
}

#content{
width:80%;
height:470px;
overflow:auto;
background-color:#<?php echo $conBG; ?>;	
float:right;
	<?php 
	if($corner == "Yes"){
	echo "-webkit-border-bottom-right-radius: 20px;
	-moz-border-radius-bottomright: 20px;
	border-bottom-right-radius: 20px;
	";
	}
	?>	
}

#footer{
	float:left;
	width:20%;
	height:10%;
	background-color:#<?php echo $footBG; ?>;
	<?php 
	if($corner == "Yes"){
	echo "-webkit-border-bottom-left-radius: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-bottom-left-radius: 20px;";
	}
	?>	
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
background-color:#<?php echo $navBG; ?>;	
text-align:center;
padding:8px;
text-decoration:none;
<?php
if($iscapital == "Yes"){
	echo 'text-transform:uppercase;';
}else{
	echo 'text-transform:none;';
}
?>}
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
?>}
a.navSelected:hover,a.navSelected:active
{
background-color:#<?php echo $navhov; ?>;
display:block;
width:100%;
} 
<?php
}else if($layout == "styles5"){
?>
html, body{
	height:90%;
	min-height:90%;
	width:99%;
	background-color:#<?php echo $siteBG; ?>;	

}

#wrapper{
	width:<?php echo $width; ?>;
	height:100%;
	min-height:100%;
	margin-left: auto;
	margin-right: auto;
background-color:#<?php echo $conBG; ?>;	

}

#header{
width:100%;
height:25%;
overflow:hidden;
background-color:white;
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

#nav{
width:20%;
height:420px;
margin-top:0px;
float:left;
}

#content{
width:80%;
height:420px;
overflow:auto;
background-color:#<?php echo $conBG; ?>;	
float:right;

}

#footer{
float:right;
	width:80%;
	height:10%;
	background-color:#<?php echo $footBG; ?>;
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
background-color:#<?php echo $navBG; ?>;	
text-align:center;
padding:8px;
text-decoration:none;
<?php
if($iscapital == "Yes"){
	echo 'text-transform:uppercase;';
}else{
	echo 'text-transform:none;';
}
?>}
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
?>}
a.navSelected:hover,a.navSelected:active
{
background-color:#<?php echo $navhov; ?>;
display:block;
width:100%;
} 
<?php
}
?>
</style>


	<title>Home</title>

</head>
<body>
</form>
		<div id="header">
			HEADER
		</div>

		<div id="nav">
			<ul class="ulnav">
				<li class="linav"><a class="nav" href='#'>Link 1</a>
				<li class="linav"><a class="navSelected" href='#'>Link 2 (current page)</a>
				<li class="linav"><a class="nav" href='#'>Link 3</a>
				<li class="linav"><a class="nav" href='#'>Link 4</a>
			</ul>
		</div>

		<div id="content">
		<?php
			if($layout == "styles1"){
				echo "CONTENT (Just this section scrolls)";
			}
			else if($layout == "styles2"){
				echo "CONTENT(The whole page scrolls)";
			}else{
				echo "CONTENT";
			}
		?>
		</div>

		<div id="footer">
			FOOTER <form method="post">
<input type="button" value="Close Window"
onclick="window.close()">
</form>
		</div>
	
	</div>
	
</body>
</html>
